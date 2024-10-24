# API Prueba	
Ejemplo de Endpoint con PHP para inserción y consultas de datos, utilizando JWT como metodo de autenticación. El servicio está publicado en Heroku:

    https://amethgabriel-api-php.herokuapp.com/

## Uso
#### Obtener JWT Token
    https://amethgabriel-api-php.herokuapp.com/auth
Se debe realizar la petición `POST` enviando un JSON con los datos del usuario.
Ejemplo:
```json
{"nombre":"ameth","email":"amethgabriel@hotmail.com"}
```
Esta petición retornará un JWT que se debe utilizar para todas las demás peticiones. Ejemplo:
```json
    {
        "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NTM5NTE1NTksImV4cCI6MTY1NDAzNzk1OSwiZGF0YSI6eyJub21icmUiOiJhbWV0aCIsImVtYWlsIjoiYW1ldGhnYWJyaWVsQGhvdG1haWwuY29tIn19.Lqq8LZi4z8zrj4H53j9Behi_nRtAZMyHOl5eKkfWvtI"
    }
```
#### Registrar un nuevo usuario
Enviar una solicitud `POST` al siguiente endpoint, enviando el JWT en la autorización Bearer

    https://amethgabriel-api-php.herokuapp.com/usuarios
Se debe enviar en la petición un JSON con los siguientes atributos:
Ejemplo:
```json
{
	"nombre": "John Doe",
	"tipo_documento": "CC",
	"documento": "123456789",
	"correo": "my.email@gmail.com"
}
```
##### Respuesta
Devolverá un JSON con la confirmación de la petición, indicando si fue exitoso o si ocurrió un error.
Ejemplo:
```json
{
    "Codigo": 0,
    "Mensaje": "Datos insertados correctamente",
    "ID": 5
}
```

#### Consultar un usuario
Enviar una solicitud `GET` al siguiente endpoint, enviando el JWT en la autorización Bearer y el parámetro `id` con el ID del usuario a consultar:

    https://amethgabriel-api-php.herokuapp.com/usuarios?id=3
##### Respuesta
```json
{
    "id_usuario": "3",
    "nombre": "Luke Evans",
    "tipo_documento": "CC",
    "documento": "789456123",
    "correo": "my.fake.email@gmail.com"
}
```
#### Registrar una nueva oferta
Enviar una solicitud `POST` al siguiente endpoint, enviando el JWT en la autorización Bearer

    https://amethgabriel-api-php.herokuapp.com/oferta_laboral
Se debe enviar en la petición un JSON con los siguientes atributos:
Ejemplo:
```json
{
	"nombre":"Desarrollador PHP", 
	"estado":1, 
	"usuarios":[1,3,5]
}
```
El valor del atributo **usuarios** debe ser un array con los ID de los usuarios que van a estar relacionados a esa oferta.

#### Consultar una oferta
Enviar una solicitud `GET` al siguiente endpoint, enviando el JWT en la autorización Bearer. Esta solicitud retornará todas las ofertas y sus usuarios relacionados:

    https://amethgabriel-api-php.herokuapp.com/oferta_laboral

Puede agregar un filtro pasando el parámetro `id` con el ID de la oferta

    https://amethgabriel-api-php.herokuapp.com/oferta_laboral?id=3

##### Respuesta
```json
[
    {
        "id_oferta": "1",
        "nombre_oferta": "Desarrollador web",
        "estado": "1",
        "usuarios": [
            {
                "id_usuario": "1",
                "nombre": "John Doe",
                "tipo_documento": "CC",
                "documento": "123456789",
                "correo": "my.email@gmail.com"
            },
            {
                "id_usuario": "2",
                "nombre": "Luke",
                "tipo_documento": "CC",
                "documento": "789456123",
                "correo": "my.fake.email@gmail.com"
            }
        ]
    }
]
```
