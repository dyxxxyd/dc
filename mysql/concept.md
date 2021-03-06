#### 常用SQL
```sql
// 建表
create table `user` (
  `id` int(10) not null unsigned auto_increment,
  `name` varchar(255) not null,
  primary key (`id`)
) ENGINE=InnoDB charset=utf8;

alter table user add `age` tinyint(3) default '0'
alter table user change name nickname varchar(255)
alter table user drop name
// add index
alter table user add index user_name(`name`)
alter table user add primary key(`id`)
alter table user drop index user_name

// 查询严格区分大小写
select * from table where binary name = 'name'
// 查询保持IN中的顺序
select * from table where id in (1,2,3,4,5) order by field(id, 1,2,3,4,5)
// 表中随机取记录
select * from table where id >= (select floor(max(id) * rand()) from table) order by id limit 1
```
#### MyISAM, InnoDB  
|  | MyISAM | InnoDB |
| --- | --- | --- |
| 存储结构 | 每个MyISAM在磁盘上存储为三个文件 .frm文件存储表定义，.myd数据文件， .myi索引文件 |  |
| 存储空间 | 索引和数据是分开的，并且索引有压缩，内存利用率提高能加载更多索引（可被压缩，存储空间较小） | 需要更多的内存，会在主内存中建立专用的缓冲池用于高速缓冲数据和索引。索引和数据是紧密捆绑的，没有使用压缩会造成体积庞大 |
| 事务处理 | 不支持外键和事务 | 支持外键和事务 |
| 全文索引 | 支持fulltext全文索引，不支持中文 | 不支持全文索引，可以使用sphinx插件支持，效果更好 |
| 表锁支持 | 只支持表锁，用户在操作时， select/update/insert/delete都会自动加锁 | 支持行锁提高并发操作（where条件为索引项有效，否则使用表锁，比表锁消耗更多内存） |
| 索引结构 | 使用B+Tree为索引结构，叶节点存放数据地址 | B+Tree作为索引结构，叶节点保存了完整的数据记录 |
| 适用场景 | 多读少写，不需要事务 | 可靠性要求高（要求事务），表更新和查询都频繁，并且表锁定的机会比较大 |

**MySQL索引的优缺点**  
合理设置索引可以加速查询结果返回，缺点：索引占用磁盘空间，对于写入操作（insert/update/delete）索引会降低他们的速度，因为MySQL不仅要把改动数据写入数据文件，还要把这些改动写入索引文件。

**MySQL队列，排他锁，死锁**  
默认情况下MyISAM是表级锁，所以同时操作单表的多个动作只能以队列的方式进行。排他锁又叫写锁，在SQL执行过程中为排除其他请求而写锁，在执行完毕后会自动释放。  
死锁：两个或多个事务在同一资源上互相占用，并请求对方占用的资源，从而导致恶性循环的现象。  
死锁解决：InnoDB会将最少级别排他锁的事务进行回滚，或者找到线程号，杀掉线程ID

**常用优化**  
1. 选用合适的字段类型，避免数据库增加不必要的空间，字段尽量不要设置为 NULL
2. 使用 join 代替子查询，使用 union 代替历史表
3. 尽量不要使用外键，除非必须保持数据库表之间的一致性和完整性（逻辑上关联即可，减少额外的的资源消耗来进行一致性和完整性校验）
4. 尽量不要使用视图，复杂的逻辑应由应用程序完成
5. 分库分表，读写分离
6. 合理设置主键及索引，索引列尽量不要参与计算，尽量扩展索引
7. 数据库字段冗余

**MySQL索引失效**  
1. or
2. like '%char'， %在查询字符串前
3. 字段是字符型，查询条件没加引号
4. 使用全表扫描比使用索引快
5. 单独使用组合索引非第一位置的索引列

#### 分片，分区，分表及主从同步（复制）的概念

分片：把数据库横向扩展到多个物理节点上的一种有效的方式，其主要目的是为了突破单节点数据库服务器的IO能力限制，解决数据库扩展性问题  
分区：把一张表的数据分成多个区块，这些区块可以在同一磁盘上，也可以在不同磁盘上。数据分区是一种物理数据库设计技术，目的是为了在特定的SQL操作中减少数据库总量以缩减响应时间  
分表：把一张表分成多个小表  
主从同步：MySQL的主从复制并不是数据库磁盘上的文件直接拷贝，而是通过逻辑的binlog日志复制到要同步的服务器本地，然后由本地的线程读取日志里面的SQL语句重新应用到MySQL数据库中。

#### 乐观锁，悲观锁，分布式锁

悲观锁：传统关系数据库里常用，每次拿数据都会上锁。行锁、表锁、读锁、写锁。悲观锁的实现往往依靠数据库提供的锁机制。  
乐观锁：每次拿数据时认为别人不会修改，但在更新时会判断在此期间别人有无更新这个数据，可以使用版本号等机制。多用于多读应用，这样可以提高吞吐量  
分布式锁：控制分布式系统同步访问共享资源的一种方式。在分布式环境中一个方法在同一时间只能被一个机器的一个线程执行。  
特性：高可用、高性能的获取锁和释放锁，具备可重入特性，锁失效机制防止死锁，具备非阻塞机制。  
实现方式：1. 基于数据库实现分布式锁。2. 基于缓存Redis等实现分布式锁。3. 基于zookeeper实现分布式锁

#### 事务

事务通过行锁、表锁、乐观锁、悲观锁和排他锁实现事务隔离
| 隔离级别 | 读数据一致性 | 脏读 | 不可重复读 | 幻读 |
| --- | --- | --- | --- | --- |
| 未提交读(read uncommitted) | 最低级别，只能保证不读取物理上损坏的数据，事务可以看到其他事务没有提交的数据 | 是 | 是 | 是 |
| 已提交读(read committed) | 语句级，事务可以看到其他事务已经提交的数据 | 否 | 是 | 是 |
| 可重复读(repeatable read) | 事务级，事务中两次查询的结果相同 | 否 | 否 | 是 |
| 可序列化(serializable) | 串行(与并发矛盾) | 否 | 否 | 否 |

```sql
set session transaction isolation level repeatable read;
```

脏读、不可重复读和幻读，其实都是数据库读一致问题，必须有数据库提供事务隔离，方式有：
1. 读取数据前，对其加锁，阻止其他事务对数据进行修改
2. 不加锁，通过一定机制生成一个请求数据时间点的一致性数据快照

可重复读和可序列化 2个事务是不必须加锁的，因为其他会话的事务无法取得这两种事务中执行的数据，永远获取的是原始数据。

#### 读写分离注意点
为保证数据库数据的一致性，所有对于数据库的更新操作都是针对主数据库的，但是读操作可以针对从数据库进行。大多数站点的数据库读比写操作更加密集，而且查询条件相对复杂，数据库的大部分性能消耗在查询操作上。
主从复制数据是异步完成的，这就导致主从数据库中的数据有一定的延迟，在读写分离的设计中必须要考虑这点。以博客为例，用户在登录后发表一篇文章，他需要马上看到自己的文章，但是对于其他用户来说可以允许延迟一段时间(1min/5min..)，不会造成什么问题。这时对于当前用户就需要读主数据库，对于其他访问量更大的外部用户可以读从数据库。
- 适当放弃一致性：在一些实时性要求不高的场合，我们可以适当放弃一致性要求。这样可以充分利用多种手段来提高系统吞吐量，例如：页面缓存、分布式数据缓存、数据库读写分离、查询数据搜索索引化。
- 可以通过程序控制：将强一致性要求的功能(存钱/取钱)的读写操作均指向主数据库，或者将写操作采用“双写”的方式实现；而弱一致性(最终一致性)要求的功能(更新微博（写）、金融账户查询（读）)而实现读写分离。

#### 水平分库分表切分规则  
1. range：从0～10000一个表，10001～20000一个表
2. hash取模：对用户ID进行取模，分配到不同的数据库/表
3. 地理区域
4. 时间：将6个月/一年前的数据分割出去
注：水平分表是将数据保存在同一库中，所以库级别还是会有IO瓶颈

#### 分库分表后面临的问题  
1. 事务支持
分库分表后，就成了分布式事务了。如果依赖数据库本身的分布式事务管理功能去执行事务，将付出高昂的性能代价；如果由应用程序去协助控制，形成逻辑上的事务，又会造成编程方面的负担。
 - 方案一：使用分布式事务
  - 优点：交由数据库管理，简单有效
  - 缺点：性能代价高，特别是shard越来越多时
- 方案二：由应用程序和数据库共同控制
 - 原理：将一个跨多个数据库的分布式事务拆分成多个仅处于单个数据库上面的小事务，并通过应用程序总控各个小事务
 - 优点：性能上有优势
 - 缺点：需要应用程序在事务控制上做灵活设计
2. 多库/表结果集合并（count，group by，order by）
解决方案：分别在各个节点上得到结果后通过应用程序进行合并，和join不同的是每个节点的查询可以并行执行，因此很多时候它的速度要比单一表快很多，如果结果集很大，对应用程序内存的消耗是一个问题。
3. 跨库/表 join
 - 全局表：有可能系统中所有模块都可能会依赖一些表（类似数据字典）。为了避免跨库join查询，可以将这类表在其他数据库中均保存一份，同时这类数据也很少发生修改，所以也不用太担心“一致性”问题
 - 字段冗余：避免join查询
 - 分两次查询，在第一次查询的结果集中找出关联数据ID，根据这些ID发起第二次请求得到关联数据。
 4. ID问题
 一旦数据库被切分到多个物理节点上，我们将不能再依赖数据库自身的主键生成机制