# 自推荐－后端API文档


##正片开始
##用户注册登录
###用户的登录
>http://123.206.18.103/Market_BE/public/index.php/admin/auth/login

数据传输方式为：POST

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入用户名  | 15933445710
password(string) | 传入密码  | 123456

登录成功将返回

`
{
    "code": 0,
    "data": {
        "user": {
            "userId": 31,
            "mobile": "15933445710"
        }
    },
    "token": "289e139fdc36a936105a4211fb726dbb39188a3d"
}
`

如果登录失败将返回

`{"status":1,"msg":"密码错误"}`
`{"status":2,"msg":"用户不存在"}`

