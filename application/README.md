# 自推荐－后端API文档


## 正片开始

## Token的单独验证接口
> http://123.206.18.103/Market_BE/public/index.php/admin/auth/validateToken?token=8fafecf4a5448d83944a57b3a9636caaae94f71c

数据传输方式：GET

数据传输格式为：JSON


参数(类型) | 说明 | 示例
----|------|----
token(string) | 传入token  | 8fafecf4a5448d83944a57b3a9636caaae94f71c

验证成功返回

`{"code":0,"msg":"token正常","token":"8fafecf4a5448d83944a57b3a9636caaae94f71c"}`

验证失败返回

`{"code":1,"msg":"token错误，请重新登录","token":"8fafecf4a5448d83944a57b3a9636caaae94f71"}`
`{"code":2,"msg":"token过期，请重新登录","token":"8fafecf4a5448d83944a57b3a9636caaae94f71"}`




## 用户注册登录
### 用户的登录
> http://123.206.18.103/Market_BE/public/index.php/admin/auth/login

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


### 用户注册
> http://123.206.18.103/Market_BE/public/index.php/admin/auth/register

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


## 忘记密码
###一、发送验证码(123456)
> http://123.206.18.103/Market_BE/public/index.php/admin/forget/sendcode
数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入手机号  | 15603302558

手机号必须唯一

注册成功将返回：

`{"code":0,"msg":"已发送验证码，请注意查收"}`


注册数据错误将返回例如
`{"code":1,"msg":"手机号不存在"}`

###二、重置密码
> http://123.206.18.103/Market_BE/public/index.php/admin/forget/resetPassword
数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入手机号  | 13223346690
password(string) | 传入新密码  | 12345678
confirm(string) | 传入确认新密码  | 12345678
verify(string) | 传入验证码  | 123456

手机号必须唯一，验证码唯一，验证码未过期，密码与确认密码必须一致

注册成功将返回：

`{"code":0,"msg":"已重置密码，请重新登录"}`


注册数据错误将返回例如
`{"code":1,"msg":"验证码错误"}`
`{"code":2,"msg":"验证码已失效"}`



## 商品的增删改查

### 添加商品
> http://123.206.18.103/Market_BE/public/index.php/admin/goods/add

数据传输方式：POST

数据传输格式为：JSON


参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入goods_id，可不填  | 1
shop_id(int) | 传入shop_id  | 1
cat_id(string) | 传入cat_id，必填  | 1
goods_name(string) | 传入goods_name，必填   | 衬衫
goods_detail(string) | 传入goods_detail   | 这是一条'大'咸鱼
goods_rate(int) | 传入goods_rate   | 10
monthly_sales(int) | 传入monthly_sales   | 25
goods_purchases(int) | 传入goods_purchases   | 50
goods_price(int) | 传入goods_price，必填   | 84
goods_address(int) | 传入goods_address   | 南京路
goods_distance(string) | 传入goods_distance  | 2km
goods_img\[\](file) | 传入goods_img[],可上传多个图片  | /public/static/img/1.jpg
goods_click(int) | 传入goods_click  | 10
is_on_sale(bool) | 传入is_on_sale  | 1
sales_volume(string) | 传入sales_volume  | 100
goods_weight(string) | 传入goods_weight  | 50g
goods_size(string) | 传入goods_size  | 100cm*100cm


验证成功返回

`{"code":0,"msg":"添加数据成功"}`

验证失败返回

`{"code":1,"msg":"validate验证失败提示信息"}`
`{"code":2,"msg":"该商品id已存在！"}`
`{"code":3,"msg":"商品图不能为空"}`
`{"code":4,"msg":"数据传输方法错误"}`



### 删除商品
> http://123.206.18.103/Market_BE/public/index.php/admin/goods/del

数据传输方式为：DELETE

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入商品id  | 2

删除成功将返回

`{"code": 0,"msg":"删除成功"}`

如果删除失败将返回

`{"code":1,"msg":"删除失败，请稍后再试"}`
`{"code":4,"msg":"数据传输方法错误"}`


### 修改商品
> http://123.206.18.103/Market_BE/public/index.php/admin/goods/edit

数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
shop_id(int) | 传入shop_id  | 1
cat_id(string) | 传入cat_id，必填  | 1
goods_name(string) | 传入goods_name，必填   | 衬衫
goods_detail(string) | 传入goods_detail   | 这是一条'大'咸鱼
goods_rate(int) | 传入goods_rate   | 10
monthly_sales(int) | 传入monthly_sales   | 25
goods_purchases(int) | 传入goods_purchases   | 50
goods_price(int) | 传入goods_price，必填   | 84
goods_address(int) | 传入goods_address   | 南京路
goods_distance(string) | 传入goods_distance  | 2km
goods_img\[\](file) | 传入goods_img[],可上传多个图片  | /public/static/img/1.jpg
goods_click(int) | 传入goods_click  | 10
is_on_sale(bool) | 传入is_on_sale  | 1
sales_volume(string) | 传入sales_volume  | 100
goods_weight(string) | 传入goods_weight  | 50g
goods_size(string) | 传入goods_size  | 100cm*100cm


修改成功将返回：

`{"code":0,"msg":"修改数据成功"}`

注册数据错误将返回例如

`{"code":1,"msg":"validate验证失败提示信息"}`
`{"code":2,"msg":"请输入要修改商品的id"}`
`{"code":3,"msg":"商品图不能为空"}`
`{"code":4,"msg":"数据传输方法错误"}`



### 查询商品
>http://123.206.18.103/Market_BE/public/index.php/admin/goods/show

数据传输方式为：GET

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入商品id  | 1

查询成功将返回

`
{`<br>`
  "code": 0,`<br>`
  "goods_id": 1,`<br>`
  "shop_name": "咸鱼店",`<br>`
  "goods_name": "大咸鱼",`<br>`
  "goods_detail": "bilibili老咸鱼",`<br>`
  "goods_rate": 10,`<br>`
  "monthly_sales": 66,`<br>`
  "goods_purchases": 666,`<br>`
  "goods_price": 123,`<br>`
  "shop_desc": "专业腌制万年老咸鱼，不咸不要钱",`<br>`
  "shop_rate": 10,`<br>`
  "goods_address": "南京路",`<br>`
  "goods_distance": 2344,`<br>`
  "flag":0`<br>`
}
`

如果查询失败将返回

`{"code":1,"msg":"查询数据失败,请检查商品id：是否存在，且稍后再试"}`
`{"code":2,"msg":"请输入商品id"}`

### 收藏商品
>http://123.206.18.103/Market_BE/public/index.php/admin/goods/collect

数据传输方式为：POST

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入商品id  | 1
user_id(int) | 传入用户id | 17

收藏成功将返回

`{"code": 0,"msg": "收藏成功，收藏的商品id有:1,2,3"}`

收藏失败将返回

`{"code": 1,"msg":"收藏失败请稍候再试"}`
`{"code":4,"msg":"数据传输方法错误"}`

##购物清单

###查询购物清单
> http://123.206.18.103/Market_BE/public/index.php/shop/cart/showcart?mobile=13223346690

数据传输方式：GET

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入用户手机号  | 13223346690

查询成功将返回：

```json
{
    "code": 0,
    "goodsList": [
        {
            "storeName": "滴滴",
            "products": [
                {
                    "productId": 1,
                    "productName": "大咸鱼",
                    "productPrice": 123,
                    "productQuantity": 1,
                    "productImage": "",
                    "parts": [
                        {
                            "partsId": 1,
                            "partsName": "限购1件"
                        },
                        {
                            "partsId": 2,
                            "partsName": "赠送手机壳"
                        }
                    ]
                }
            ],
            "totalMoney": 123,
            "created_at": "1970-01-15 08:26:52"
        },
        {
            "storeName": "商家二",
            "products": [
                {
                    "productId": 2,
                    "productName": "长裤",
                    "productPrice": 50,
                    "productQuantity": 1,
                    "productImage": "public/image2",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 4,
                    "productName": "可乐",
                    "productPrice": 3,
                    "productQuantity": 1,
                    "productImage": "public/image4",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 5,
                    "productName": "电视",
                    "productPrice": 1000,
                    "productQuantity": 1,
                    "productImage": "public/image5",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                }
            ],
            "totalMoney": 1053,
            "created_at": "1970-01-01 17:15:33"
        },
        {
            "storeName": "商家二",
            "products": [
                {
                    "productId": 2,
                    "productName": "长裤",
                    "productPrice": 50,
                    "productQuantity": 1,
                    "productImage": "public/image2",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 4,
                    "productName": "可乐",
                    "productPrice": 3,
                    "productQuantity": 1,
                    "productImage": "public/image4",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 5,
                    "productName": "电视",
                    "productPrice": 1000,
                    "productQuantity": 1,
                    "productImage": "public/image5",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                }
            ],
            "totalMoney": 1053,
            "created_at": "1970-01-01 14:10:23"
        },
        {
            "storeName": "商家三",
            "products": [
                {
                    "productId": 3,
                    "productName": "核桃",
                    "productPrice": 25,
                    "productQuantity": 1,
                    "productImage": "public/image3",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 4,
                    "productName": "可乐",
                    "productPrice": 3,
                    "productQuantity": 1,
                    "productImage": "public/image4",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 5,
                    "productName": "电视",
                    "productPrice": 1000,
                    "productQuantity": 1,
                    "productImage": "public/image5",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                }
            ],
            "totalMoney": 25,
            "created_at": "1970-01-01 14:10:22"
        },
        {
            "storeName": "商家二",
            "products": [
                {
                    "productId": 2,
                    "productName": "长裤",
                    "productPrice": 50,
                    "productQuantity": 1,
                    "productImage": "public/image2",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 4,
                    "productName": "可乐",
                    "productPrice": 3,
                    "productQuantity": 1,
                    "productImage": "public/image4",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                },
                {
                    "productId": 5,
                    "productName": "电视",
                    "productPrice": 1000,
                    "productQuantity": 1,
                    "productImage": "public/image5",
                    "parts": [
                        {
                            "partsId": null,
                            "partsName": null
                        }
                    ]
                }
            ],
            "totalMoney": 1053,
            "created_at": "1970-01-01 11:05:11"
        }
    ]
}
```


注册数据错误将返回例如

`{"code":1,"msg":"操作失败，请重试"}`
`{"code":2,"msg":"非法调用"}`
`{"code":3,"msg":"购物清单为空"}`


##商户

###查询我的商户
> http://123.206.18.103/Market_BE/public/index.php/shop/shop/showshop?shop_id=1

数据传输方式：GET

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
shop_id(string) | 传入商户ID  | 1

查询成功将返回：

```json
{
    "code": 0,
    "storeID": 1,
    "storeName": "滴滴",
    "collectedNum": 152,
    "storeRate": 5,
    "storeSlogan": "1.开张大吉;2.全场商品满200-20;3.进店即送苹果一个;4.本店所有商品9折起;",
    "storeGoods": [
        {
            "goodClassify": "水果",
            "goods": [
                {
                    "name": "大咸鱼",
                    "price": 123,
                    "broughtNum": 66,
                    "favorableRate": "0%",
                    "imgURL": ""
                },
                {
                    "name": "核桃",
                    "price": 25,
                    "broughtNum": 0,
                    "favorableRate": "100%",
                    "imgURL": "public/image3"
                },
                {
                    "name": "电视",
                    "price": 1000,
                    "broughtNum": 0,
                    "favorableRate": "0%",
                    "imgURL": "public/image5"
                },
                {
                    "name": "apple",
                    "price": 0,
                    "broughtNum": 0,
                    "favorableRate": "0%",
                    "imgURL": ""
                }
            ]
        },
        {
            "goodClassify": "蔬菜",
            "goods": [
                {
                    "name": "长裤",
                    "price": 50,
                    "broughtNum": 0,
                    "favorableRate": "100%",
                    "imgURL": "public/image2"
                },
                {
                    "name": "可乐",
                    "price": 3,
                    "broughtNum": 0,
                    "favorableRate": "100%",
                    "imgURL": "public/image4"
                }
            ]
        }
    ]
}
```


注册数据错误将返回例如

`{"code":1,"msg":"查询失败请重试"}`
`{"code":2,"msg":"非法调用"}`
`{"code":3,"msg":"该店暂未开张，敬请期待"}`
