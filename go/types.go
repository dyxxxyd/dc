package main

import "fmt"

func main() {
	var a int // 通用整数类型
	var b int32 // 32位整数类型
	a = 15
	// b = a + a // 混合数据类型非法， a:int b:int32
	b = b + 5
	fmt.Println(a, b)
}