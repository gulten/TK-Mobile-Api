# Tk Mobile API

Larevel framework ile gerçekleştirildi.

- API + Callback

## Api Dökümantasyonu

Api dökümantasyonu ve testi için eklediğim paket "darkaonline/l5-swagger": "^8.0"s

- http://tk-mobile-api-url/api/documentation

## Cache Driver

Device tablosunda işlemlerin hızlanmasına katkı sağlayabilmek için "Redis Cache Driver" kullanıldı

## .env ekleme

- L5_SWAGGER_GENERATE_ALWAYS=true

- GOOGLE_SERVICE_ENDPOINT=
- GOOGLE_SERVICE_USERNAME=
- GOOGLE_SERVICE_PASSWORD=

- IOS_SERVICE_ENDPOINT=
- IOS_SERVICE_USERNAME=
- IOS_SERVICE_PASSWORD=

- L5_SWAGGER_CONST_HOST=


## Worker Bilgilendirme

DB içerisinde milyonlarca veri bulunacağını göz önüne aldığımızda ve iOS ve Google API’ları mobile application taraflı rate-limitleri bulunması, aynı gün içerisinde belli istek sayısının servis tarafında cevaplanması, diğer isteklerin ise limite takılması sebebiyle cevaplanmaması sorun olacaktır. Bu problemin üstesinden gelinebilmesi için servislerin bize sunduğu publish/subscribe (pub/sub) mimarisine uygun hizmetler varsa onlardan faydalanabilir. Bu hizmetler periyodik olarak çalışan sistemlerle uyumlu değildir. ("WebSocket - Receiving Broadcasts - Listening For Events").
