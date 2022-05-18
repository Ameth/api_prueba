# API Prueba	
Ejemplo de Endpoint con PHP para inserción y consultas de datos, utilizando JWT como metodo de autenticación

## Uso
#### Obtener JWT Token
```json
{"nombre":"ameth","email":"amethgabriel@hotmail.com"}
```
#### Registrar un nuevo usuario
```json
{"nombre": "Ameth","tipo_documento": "CC","documento": "1140847389","correo": "amethgabriel@hotmail.com"}
```
#### Consultar un usuario
    http://servername/usuarios?id=3
##### Respuesta
```json
{
    "id_usuario": "3",
    "nombre": "Britney Ordoñez",
    "tipo_documento": "CC",
    "documento": "1002163137",
    "correo": "britneypaola@gmail.com"
}
```
#### Registrar una nueva oferta
El valor de **usuarios** debe ser un array con los ID de los usuarios que van a estar relacionados a esa oferta.

```json
{"nombre":"Desarrollador PHP", "estado":1, "usuarios":[1,3,5]}
```
#### Consultar una oferta
    http://servername/oferta_laboral

Agregando filtro

    http://servername/oferta_laboral?id=3

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
                "nombre": "ameth",
                "tipo_documento": "CC",
                "documento": "1140847389",
                "correo": "amethgabriel@hotmail.com"
            },
            {
                "id_usuario": "2",
                "nombre": "Ameth",
                "tipo_documento": "CC",
                "documento": "1140847389",
                "correo": "amethgabriel@hotmail.com"
            }
        ]
    }
]
```
