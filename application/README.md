# 自推荐－后端API文档


##正片开始

##Token的单独验证接口
>http://123.206.18.103/Market_BE/public/index.php/admin/auth/validateToken?token=8fafecf4a5448d83944a57b3a9636caaae94f71c

数据传输方式：GET
数据传输格式为：JSON
参数(类型) | 说明 | 示例
----|------|----
token(string) | 传入token  | 8fafecf4a5448d83944a57b3a9636caaae94f71c

验证成功返回

`{"code":0,"msg":"token正常","token":"8fafecf4a5448d83944a57b3a9636caaae94f71c"}`

验证失败返回

`{"code":1,"msg":"token错误，请重新登录","token":"8fafecf4a5448d83944a57b3a9636caaae94f71"}`
`{"code":1,"msg":"token过期，请重新登录","token":"8fafecf4a5448d83944a57b3a9636caaae94f71"}`




##用户注册登录
###用户的登录
>http://123.206.18.103/Market_BE/public/index.php/admin/auth/login

数据传输方式为：POST

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入手机号  | 15933445710
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

`{"code":1,"msg":"密码错误"}`
`{"code":1,"msg":"用户不存在"}`


###用户注册
>http://123.206.18.103/Market_BE/public/index.php/admin/auth/register
数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
username(string) | 传入用户名  | zhangqirong
password(string) | 传入密码  | 123456
confirm(string) | 传入重复密码  | 123456
mobile(string) | 传入手机  | 15603302558

手机号必须唯一，用户名必须唯一，密码与确认密码必须一致

注册成功将返回：

`{"code":0,"msg":"注册成功"}`

注册数据错误将返回例如

`{"code":1,"msg":"用户名已经存在"}`
`{"code":1,"msg":"手机已经注册"}`




