CREATE TABLE  productos (
  id_producto SERIAL  primary key not null,
  descripcion_producto VARCHAR(60) NOT NULL,
  categoria_producto VARCHAR(45) NOT NULL,
  fecha_producto DATE NOT NULL,
  precio_producto float NOT NULL,
  stock_producto INT NOT NULL
);
INSERT INTO PRODUCTOS(descripcion_producto,categoria_producto,fecha_producto,precio_producto,stock_producto) VALUES('Camisa','Camisas','30/12/2021',39.99,50);
INSERT INTO PRODUCTOS(descripcion_producto,categoria_producto,fecha_producto,precio_producto,stock_producto) VALUES('Pantalon','Pantalones','30/12/2021',89.89,10);
select*from productos;

CREATE TABLE clientes (
  id_cliente SERIAL primary key NOT NULL ,
  apellidos_cliente VARCHAR(45) NOT NULL,
  nombres_cliente VARCHAR(45) NOT NULL,
  dni_cliente INT NOT NULL,
  fecha_cliente DATE NOT NULL,
  ciudad_cliente VARCHAR(45) NOT NULL,
  provincia_cliente VARCHAR(45) NOT NULL,
  direccion_cliente VARCHAR(45) NOT NULL,
  email_cliente VARCHAR(45) NOT NULL,
  telefono_cliente INT NOT NULL
);

INSERT INTO CLIENTES(apellidos_cliente,nombres_cliente,dni_cliente,fecha_cliente,ciudad_cliente,provincia_cliente,direccion_cliente,email_cliente,telefono_cliente) VALUES('Pereira','Emerson',12345671,'30/12/21','Lima','Lima','Rimac','EmersonPereira@gmail.com',987654321);
INSERT INTO CLIENTES(apellidos_cliente,nombres_cliente,dni_cliente,fecha_cliente,ciudad_cliente,provincia_cliente,direccion_cliente,email_cliente,telefono_cliente) VALUES('Soto','Ezze',5468782,'30/12/21','Lima','Lima','Rimac','EzzeS@gmail.com',955654845);
select*from clientes;


CREATE TABLE IF NOT EXISTS empleados (
  id_empleado serial primary key NOT NULL ,
  apellidos_empleado VARCHAR(45) NOT NULL,
  nombres_empleado VARCHAR(45) NOT NULL,
  dni_empleado INT NOT NULL,
  telefono_empleado INT NOT NULL,
  fecha_nacimiento_empleado DATE NOT NULL,
  fecha_ingreso_empleado DATE NOT NULL,
  email_empleado VARCHAR(45) NOT NULL
);

INSERT INTO EMPLEADOS(apellidos_empleado,nombres_empleado,dni_empleado,telefono_empleado,fecha_nacimiento_empleado,fecha_ingreso_empleado,email_empleado) VALUES('Villacorta','Diego',7854632,987654321,'25/10/2021','25/10/2021','Diego_19@gmail.com');
INSERT INTO EMPLEADOS(apellidos_empleado,nombres_empleado,dni_empleado,telefono_empleado,fecha_nacimiento_empleado,fecha_ingreso_empleado,email_empleado) VALUES('La Torre','Angel',8254638,987589659,'12/08/2021','25/10/2021','Angel_T@gmail.com');
select*from empleados;

CREATE TABLE IF NOT EXISTS locales (
  id_local SERIAL primary key NOT NULL ,
  direccion_local VARCHAR(45) NOT NULL,
  nombre_local VARCHAR(45) NOT NULL
);
drop table locales;

INSERT INTO LOCALES(direccion_local,nombre_local) VALUES('Local Rimac','Local Principal');
INSERT INTO LOCALES(direccion_local,nombre_local) VALUES('Local Los Olivos','Local Secundario');
select*from locales;



CREATE TABLE  pedidos(
  id_pedido SERIAL primary key NOT NULL,
  fecha_pedido DATE NOT NULL,
  id_cliente INT NOT NULL,
  id_empleado INT NOT NULL,
  id_local INT NOT NULL,
  FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (id_empleado) REFERENCES empleados (id_empleado)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (id_local) REFERENCES locales (id_local)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
select*from pedidos;

CREATE TABLE IF NOT EXISTS detalle_pedido (
  id_detalle_pedido SERIAL primary key NOT NULL ,
  cantidad_detalle_pedido INT NOT NULL,
  total_detalle_pedido FLOAT NOT NULL,
  id_producto INT NOT NULL,
  id_pedido INT NOT NULL,
  FOREIGN KEY (id_producto) REFERENCES productos (id_producto)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (id_pedido) REFERENCES pedidos (id_pedido)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
select*from detalle_pedido;


create or replace function F2() returns trigger
as
$$
declare
begin
	-- Decrementa la cantidad del pedido al stock del producto
	CASE TG_OP 
	WHEN 'INSERT' THEN
		update productos set stock_producto = stock_producto - new.cantidad_detalle_pedido where id_producto = new.id_producto;
	END CASE;
	return new;
end
$$
Language plpgsql;

create trigger NUEVO_STOCK_PEDIDO after insert on detalle_pedido
for each row
execute procedure F2();



CREATE TABLE IF NOT EXISTS materiales (
  id_material SERIAL primary key NOT NULL ,
  descripcion_material VARCHAR(45) NOT NULL,
  fecha_material DATE NOT NULL,
  precio_material FLOAT NOT NULL,
  stock_material INT NOT NULL
);

INSERT INTO MATERIALES(descripcion_material,fecha_material,precio_material,stock_material) VALUES('Tela Blanca','22/11/2021',25.99,50);
INSERT INTO MATERIALES(descripcion_material,fecha_material,precio_material,stock_material) VALUES('Tela Negra','23/11/2021',22.99,40);
select*from materiales;


CREATE TABLE IF NOT EXISTS proveedores (
  id_proveedor SERIAL primary key NOT NULL ,
  nombre_proveedor VARCHAR(45) NOT NULL,
  direccion_proveedor VARCHAR(45) NOT NULL,
  fecha_proveedor DATE NOT NULL,
  email_proveedor VARCHAR(45) NOT NULL,
  telefono_proveedor INT NOT NULL
);
INSERT INTO PROVEEDORES(nombre_proveedor,direccion_proveedor,fecha_proveedor,email_proveedor,telefono_proveedor) VALUES('Gamarra','La victoria','21/11/2021','GamarraCity@gmail.com',987654321);
INSERT INTO PROVEEDORES(nombre_proveedor,direccion_proveedor,fecha_proveedor,email_proveedor,telefono_proveedor) VALUES('Gamarra2','La victoria','19/11/2021','Gamarra2City@gmail.com',123456789);
select*from proveedores;


CREATE TABLE IF NOT EXISTS compras (
  id_compra SERIAL primary key NOT NULL ,
  fecha_compra DATE NOT NULL,
  id_empleado INT NOT NULL,
  id_proveedor INT NOT NULL,
  FOREIGN KEY (id_empleado) REFERENCES empleados (id_empleado)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (id_proveedor)
    REFERENCES proveedores (id_proveedor)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
select*from compras;


CREATE TABLE IF NOT EXISTS detalle_compra (
  id_detalle_compra SERIAL primary key NOT NULL ,
  cantidad_material INT NOT NULL,
  total_compra FLOAT NOT NULL,
  id_compra INT NOT NULL,
  id_material INT NOT NULL,
  FOREIGN KEY (id_material) REFERENCES materiales (id_material)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (id_compra) REFERENCES compras (id_compra)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
select*from detalle_compra;

create or replace function F1() returns trigger
as
$$
declare
begin
	-- Aumenta la cantidad de la compra al stock del material
	CASE TG_OP 
	WHEN 'INSERT' THEN
		update materiales set stock_material = stock_material + new.cantidad_material where id_material = new.id_material;
	END CASE;
	return new;
end
$$
Language plpgsql;

create trigger NUEVO_STOCK_MATERIAL after insert on detalle_compra
for each row
execute procedure F1();




CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario SERIAL primary key NOT NULL ,
  nombre_usuario VARCHAR(45) NOT NULL,
  apellido_usuario VARCHAR(45) NOT NULL,
  email_usuario VARCHAR(45) NOT NULL,
  username_usuario VARCHAR(45) NOT NULL,
  password_usuario VARCHAR(45) NOT NULL
);

INSERT INTO USUARIOS(nombre_usuario,apellido_usuario,email_usuario,username_usuario,password_usuario) VALUES('Dante','Harold','dante@gmail.com','DanteHarold','123');
select*from usuarios;