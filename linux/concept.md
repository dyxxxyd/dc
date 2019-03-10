#### Linux 常用命令

1. cd 切换当前目录，可以是绝对路径或者相对路径
2. ls 查看文件与目录，ls -l(ll) 列出长数据串，包含文件的属性与权限，ls -a 列出全部文件，包括隐藏文件
3. grep 文本搜索 grep -i "php" test1.txt 主要参数：
 - -i：不分区大小写，只使用于字母字符
 - -l：查询多文件时只输出包含匹配字符和文件名
 - -n：显示匹配的内容及行号
4. find 查找 find -name 文件名：找匹配的文件名
5. mkdir 创建指定的名称的目录
 - -m：设置权限 mkdir -m 777 test3
 - -p：mkdir -p test2/test3 递归创建多个目录，如test2不存在也会自动创建
6. cp 复制文件，还可以把多个文件一次性的复制到一个目录下
 - cp -a file1 file2: 连同文件的所有特性把文件file1复制成file2
 - cp file1 file2 file3 dir: 把文件file1，file2，file3复制到目录dir中
7. mv 移动文件、目录或更名
 - mv file1 file2 file3 dir：把文件file1，file2，file3移动到目录dir中
 - mv file1 file2：把文件file1重命名为file2
8. rm 删除文件或目录
 - -f：强制删除，忽略不存在的文件，不会出现警告
 - -i：互动模式，在删除前询问用户是否操作
 - -r：递归删除，最常用于目录删除
9. ps 列出系统当前运行的进程
 - a 显示所有用户的所有进程
 - -e 显示所有进程，环境变量。 f 用树形格式来显示进程
10：kill 终止指定进程 kill -9 pid：彻底杀死某个进程
11：tar对文件进行打包，默认情况不会压缩
 - tar -jcv -f filename.tar.bz2 filename
 - tar -jtv -f filename.tar.bz2
 - tar -jxv -f filename.tar.bz2 (解压成目录为filename的目录)
 - 主选项> c:创建文件, x:释放文件, t:列出档案文件内容，
 - 辅选项>
  - -z：是否具有gzip属性或是否用gzip压缩/解压，一般格式为 xx.tar.gz/ xx.tgz
  - -j: 是否具有bzip2属性或是否用bzip2压缩或解压，一般格式为 xx.tar.bz2
  - -v: 压缩过程中显示文件
  - -f: 使用档名
12. chmod 改变文件的权限，4（读）2（写）1（执行）
 - chmod u+x file：给file的属主增加执行权限
 - chmod 751 file：给file的属主分配读、写、执行（7）的权限，给file所在的组分配读、执行权限，给其他用户分配执行权限
 - chmod u=rwx,g=rx,o=x file：上例的另一种形式
13. tail 显示文件后n行的内容。-f 循环读取，-n<行数>显示行数 ctrl+z 退出
 - tail -f 2019.log 自动刷新查看正在改变的log
 - tail -3000 2019.log 查看倒数前3000行的数据
 - tail -3000 2019.log | grep 'php' 查看倒数前3000行包含字母 php 的数据
14. head 显示文件前n行的内容