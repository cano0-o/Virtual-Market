# Virtual Market
Esquema de la base de datos

## Clientes
- id
- name
- app
- apm
- dir
- cp
- tel
- mail
- password
- rol

## Categoría
- id
- nombre
- condiciones
- observaciones

## Dimensiones
- id
- volumen
- peso

## Productos
- id
- nombre
- marca
- origen
- fotografia
- id_categoria [[esquema#Categoría]]
- stock
- id_dimensiones [[esquema#Dimensiones]]]

## Carritos
- id
- id_cliente [[esquema#Clientes]]
- id_producto [[esquema#Productos]]
- fecha
- cantidad
- subtotal

## Compras
- id
- id_carrito [[esquema#Carritos]]
- total

## Repartidores
- id
- id_compra [[esquema#Compras]]
- nombre
- tel
- correo

## Entregas
- id
- id_repartidor [[esquema#Repartidores]]
- id_cliente [[esquema#Clientes]]
- fecha_entrega
- estado
