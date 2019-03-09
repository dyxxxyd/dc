#### 时间复杂度
时间复杂度优劣：O(1), O(log<sub>n</sub>), O(n), O(nlog<sub>n</sub>), O(n<sup>2</sup>), O(n<sup>k</sup>), O(2<sup>n</sup>)

**时间复杂度求法：**  
例1：冒泡排序  
A：外层循环执行 N-1 次， 内层循环最多执行 N 次，最少执行 1 次， 平均 (N + 1) / 2  
(N - 1) * ( N + 1) / 2 = (N<sup>2</sup> - 1) / 2 按照计算复杂度的原则，去掉常数，去掉最高项系数，复杂度为 O(N<sup>2</sup>)  

例如：二分法 折半查找 O(logn)  
A：总共有n个元素，剩余元素个数是：n, n/2, n/4, ..., n/2<sup>k</sup> (k循环次数)  
n/2<sup>k</sup> = 1 => k = log<sub>2</sub>n => logn

#### 空间复杂度