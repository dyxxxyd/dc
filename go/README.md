### 版本更新

1. 移除旧版

```
sudo rm -rf /usr/local/go
```

2. 下载最新安装包并安装

```
sudo tar -C /usr/local -xzf /Users/dc/Downloads/go1....tar.gz
```

3. 查看环境变量

```
echo $PATH | grep "/usr/local/go/bin"
```