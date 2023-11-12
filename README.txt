
La ruta $router->addRoute('user/token', 'GET', 'userApiController', 'getToken' ) genera un token que luego podra ser utilizado, la consulta a postman es:localhost/TPEWEB/entrega2/api/user/token y en la parte de Authorization
se debe pasar como Username "webadmin" y como Password "admin"

TABLA MATERIALES:

La ruta $router->addRoute('materiales', 'GET', 'materialesApiController','get') trae toda lista de ventas de materiales, la consulta a postman seria con el metodo GET localhost/TPEWEB/entrega2/api/materiales/ esto traeria toda la lista,
para traer un item especifico le pasariamos un id existente, como por ejemplo 188, entonces la consulta quedaria asi localhost/TPEWEB/entrega2/api/materiales/188 y esto traeria de la lista ventas, el item con ese id , en caso de no
existir el id, dara error. 

La ruta $router->addRoute('materiales', 'POST', 'materialesApiController', 'addItem' )  se utiliza para agregar un item en la tabla materiales, la consulta a postman seria con el metodo POST localhost/TPEWEB/entrega2/api/materiales/ y en
el apartado de body necesitariamos mandar un arreglo asi,  {                       puede ser con distintos datos, pero siempre respetando que sean datos numericos, de lo contrario dara error.
SE DEBE ENVIAR EL TOKEN GENERADO A TRAVES DEL HEADER        "idProducto": 18,
        					            "unidades": 550,
        						    "montoTotal": 70000,
                                                            "cliente": 26
    							    } 

La ruta $router->addRoute('materiales/:ID', 'PUT', 'materialesApiController', 'update') se utiliza para modificar un item en la tabla materiales, la consulta a postman seria con el metodo PUT  localhost/TPEWEB/entrega2/api/materiales/170
el 170 se puede modificar por un id existente, previamente encontrado con el metodo GET, y tenemos que pasar por body un arreglo asi,{                        siempre respetando que sean datos numericos, de lo contrario dara error.
SE DEBE ENVIAR EL TOKEN GENERADO A TRAVES DEL HEADER        						                      "idProducto": (dato numerico),
        					                                                                              "unidades": (dato numerico),
        						                                                                      "montoTotal": (dato numerico),
                                                                                                                              "cliente": (dato numerico)
    							                                                                      }

La ruta  $router->addRoute('materiales/:ID', 'DELETE', 'materialesApiController', 'eliminarVenta' ) se utiliza para eliminar un item en la tabla materiales, la consulta a postman seria con el metodo DELETE
localhost/TPEWEB/entrega2/api/materiales/170 y  en el 170 se puede modificar por un id existente previamente visto en el metodo GET. en caso de no pasar un id existente, dara error.


La ruta $router->addRoute('filtrar', 'GET', 'materialesApiController', 'filtroVentas') filtra items de la tabla por unidades, si existen items con mas cantidad de unidades de el parametro pasado, devuelve el arreglo con ellos.
La consulta a postman es con el metodo GET localhost/TPEWEB/entrega2/api/filtrar?valor=500 donde el 500 se puede modificar por otro numero, pero no por otra letra, de ser asi, daria error.


La ruta $router->addRoute('orden', 'GET', 'materialesApiController', 'listVentas' ) ordena los items de la tabla materiales de manera ascendente por default y la consulta seria asi 
GET localhost/TPEWEB/entrega2/api/orden/?order_by=unidades donde unidades, puede ser modificado por idVenta, idProducto, montoTotal, cliente si se quiere ordenar de manera descendente la consulta seria:
GET localhost/TPEWEB/entrega2/api/orden/?order_by=unidades&order=DESC, donde tambien unidades se puede modificar por cualquiera de las anteriores, pero order no se puede modificar.

La ruta $router->addRoute('paginar', 'GET', 'materialesApiController', 'paginarVentas') se utiliza para mostrar una cierta cantidad de items por pagina, la consulta a postman es:
GET localhost/TPEWEB/entrega2/api/paginar?action=listVentas&pagina=1&items_por_pagina=10 , se pueden modificar la cantidad de items por pagina y el numero de pagina, siempre y cuando se mantenga en un numero y no pase a letras, de 
lo contrario dara error.



Las otras tablas funcionan igual, solo que sin el paginar, sin el ordenar y sin el filtrar.
aca las consultas de la tabla productos:

PARA OBTENER LISTA DE PRODUCTOS:localhost/TPEWEB/entrega2/api/productos/

PARA OBTENER LISTA DE PRODUCTOS POR ID: localhost/TPEWEB/entrega2/api/productos/18    (CON ID EXISTENTE)

PARA AGREGAR UN PRODUCTO(RECORDAR PASAR TOKEN):  localhost/TPEWEB/entrega2/api/productos/  body con un arreglo similar o igual a: 
{  
   "producto": "Bolsa de cemento",
    "monto": 33555,
    "descripcion": "El cemento se utiliza para hacer hormigon, proteger las superficies, etc."
} 

PARA MODIFICAR UN PRODUCTO(RECORDAR PASAR TOKEN): localhost/TPEWEB/entrega2/api/productos/27  (CON ID EXISTENTE) body con un arreglo similar a:
{
    "producto": "Bolsaaa de cemento",
    "monto": 33555,
    "descripcion": "El cemento se utiliza para hacer hormigon, proteger las superficies, etc."
}

PARA ELIMINAR UN PRODUCTO(RECORDAR PASAR TOKEN):
localhost/TPEWEB/entrega2/api/productos/27   (CON ID EXISTENTE)




Aca las consultas de la tabla clientes:


PARA OBTENER LISTA DE CLIENTES:   GET localhost/TPEWEB/entrega2/api/clientes/

PARA OBTENER LISTA DE CLIENTES POR ID:     GET localhost/TPEWEB/entrega2/api/clientes/24    (CON ID EXISTENTE)

PARA AGREGAR UN CLIENTE(RECORDAR PASAR TOKEN): POST  localhost/TPEWEB/entrega2/api/clientes/  body con un arreglo similar o igual a 
{
    "id": 24,
    "nombre": "Agustin",
    "apellido": "martinez",
    "edad": 35
}

PARA MODIFICAR UN CLIENTE(RECORDAR PASAR TOKEN): PUT localhost/TPEWEB/entrega2/api/clientes/24  (CON ID EXISTENTE) body con un arreglo similar a:
{
    "id": 24,
    "nombre": "Agustin",
    "apellido": "gonzalez",
    "edad": 35
}

PARA ELIMINAR UN CLIENTE(RECORDAR PASAR TOKEN): localhost/TPEWEB/entrega2/api/clientes/24      (CON ID EXISTENTE)


