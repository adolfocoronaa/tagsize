-- Creamos la base de datos tennis2
create database tennis2;
-- Usamos la base de datos creada
use tennis2;
-- Creamos la tabla codigos
CREATE TABLE codigos ( 
    codigo INT NOT NULL, 
    PRIMARY KEY (codigo) 
);

-- Comentarios para la tabla codigos
ALTER TABLE codigos COMMENT = 'tabla de codigos';
ALTER TABLE codigos MODIFY COLUMN codigo INT COMMENT 'codigo de barras';

-- Creamos la tabla productos
CREATE TABLE productos ( 
    id_productos INT NOT NULL, 
    nombre_producto VARCHAR(30) NOT NULL, 
    marca_producto VARCHAR(40) NOT NULL, 
    precio_producto DECIMAL(4,1) NOT NULL, 
    stock_del_producto INT NOT NULL, 
    descripcion_producto TEXT NOT NULL, 
    imagen_producto VARCHAR(255) NOT NULL, 
    fecha_creacion_producto DATE NOT NULL, 
    PRIMARY KEY (id_productos) 
);

-- Comentarios para la tabla productos
ALTER TABLE productos COMMENT = 'Tabla de productos';
ALTER TABLE productos MODIFY COLUMN id_productos INT COMMENT 'identificador de producto';
ALTER TABLE productos MODIFY COLUMN nombre_producto VARCHAR(30) COMMENT 'nombre del producto';
ALTER TABLE productos MODIFY COLUMN marca_producto VARCHAR(40) COMMENT 'marca del producto';
ALTER TABLE productos MODIFY COLUMN precio_producto DECIMAL(4,1) COMMENT 'precio de los productos';
ALTER TABLE productos MODIFY COLUMN stock_del_producto INT COMMENT 'el stock de los productos';
ALTER TABLE productos MODIFY COLUMN descripcion_producto TEXT COMMENT 'descripcion del producto';
ALTER TABLE productos MODIFY COLUMN imagen_producto VARCHAR(255) COMMENT 'URL de la imagen';
ALTER TABLE productos MODIFY COLUMN fecha_creacion_producto DATE COMMENT 'fecha creacion del producto';

-- Creamos la tabla tallas
CREATE TABLE tallas ( 
    id_talla INT NOT NULL,
    talla DECIMAL(4,1) NOT NULL, 
    id_productos INT NOT NULL, 
    codigo INT NOT NULL, 
    PRIMARY KEY (id_talla)
);

-- Comentarios para la tabla tallas
ALTER TABLE tallas COMMENT = 'Tabla de tallas';
ALTER TABLE tallas MODIFY COLUMN id_talla INT COMMENT 'id de las tallas';
ALTER TABLE tallas MODIFY COLUMN talla DECIMAL(4,1) COMMENT 'talla del producto';

-- Creamos la tabla usuarios
CREATE TABLE usuarios ( 
    id_usuarios INT NOT NULL, 
    nombre_usuario VARCHAR(100) NOT NULL, 
    email_usuario VARCHAR(100) NOT NULL, 
    password_usuario VARCHAR(20) NOT NULL, 
    fecha_registro_usuario DATE NOT NULL, 
    tipo_usuario CHAR(1), 
    PRIMARY KEY (id_usuarios), 
    CHECK (tipo_usuario IN ('A', 'E'))
);

-- Comentarios para la tabla usuarios
ALTER TABLE usuarios COMMENT = 'Esta es la tabla de usuarios';
ALTER TABLE usuarios MODIFY COLUMN id_usuarios INT COMMENT 'identificador de usuario';
ALTER TABLE usuarios MODIFY COLUMN nombre_usuario VARCHAR(100) COMMENT 'nombre del usuario';
ALTER TABLE usuarios MODIFY COLUMN email_usuario VARCHAR(100) COMMENT 'email de usuario';
ALTER TABLE usuarios MODIFY COLUMN password_usuario VARCHAR(20) COMMENT 'contraseña para el usuario';
ALTER TABLE usuarios MODIFY COLUMN fecha_registro_usuario DATE COMMENT 'fecha de registro del usuario';
ALTER TABLE usuarios MODIFY COLUMN tipo_usuario CHAR(1) COMMENT 'tipo de usuario, empleado o administrador';

-- Claves foráneas
ALTER TABLE tallas 
    ADD CONSTRAINT tallas_codigos_FK FOREIGN KEY (codigo) 
    REFERENCES codigos (codigo);

ALTER TABLE tallas 
    ADD CONSTRAINT tallas_productos_FK FOREIGN KEY (id_productos) 
    REFERENCES productos (id_productos);

-- Describe de las tablas
describe codigos;
describe productos;
describe tallas;
describe usuarios;

-- Insert para cada una de las tablas
-- Insertar datos en la tabla codigos
INSERT INTO codigos (codigo) VALUES 
(2001), (2002), (2003), (2004), (2005);

-- Alter table para aceptar mayores precios.
ALTER TABLE productos MODIFY COLUMN precio_producto DECIMAL(7,2) NOT NULL;


-- Insertar datos en la tabla productos (tenis deportivos)
INSERT INTO productos (id_productos, nombre_producto, marca_producto, precio_producto, stock_del_producto, descripcion_producto, imagen_producto, fecha_creacion_producto) VALUES 
(1, 'Nike Air Zoom', 'Nike', 2499.9, 15, 'Tenis deportivos de alto rendimiento', 'https://example.com/nike_air_zoom.jpg', '2025-03-05'),
(2, 'Adidas Ultraboost', 'Adidas', 2299.5, 20, 'Comodidad y estilo para correr', 'https://example.com/adidas_ultraboost.jpg', '2025-03-05'),
(3, 'Puma RS-X', 'Puma', 1799.9, 10, 'Diseño moderno y gran amortiguación', 'https://example.com/puma_rsx.jpg', '2025-03-05'),
(4, 'New Balance Fresh Foam', 'New Balance', 1999.9, 12, 'Tenis ideales para largas distancias', 'https://example.com/newbalance_freshfoam.jpg', '2025-03-05'),
(5, 'Reebok Floatride', 'Reebok', 159.9, 18, 'Ligereza y resistencia para entrenamientos', 'https://example.com/reebok_floatride.jpg', '2025-03-05');

-- Insertar datos en la tabla tallas (tallas disponibles para los tenis)
INSERT INTO tallas (id_talla, talla, id_productos, codigo) VALUES 
(1, 7.5, 1, 2001),
(2, 8.0, 2, 2002),
(3, 8.5, 3, 2003),
(4, 9.0, 4, 2004),
(5, 10.0, 5, 2005);

-- Insertar datos en la tabla usuarios
INSERT INTO usuarios (id_usuarios, nombre_usuario, email_usuario, password_usuario, fecha_registro_usuario, tipo_usuario) VALUES 
(1, 'Mario Sierra', 'mario@example.com', 'pass1234', '2025-03-05', 'A'),
(2, 'Luis Pérez', 'luis@example.com', 'luispass', '2025-03-05', 'E'),
(3, 'Ana Gómez', 'ana@example.com', 'anasegura', '2025-03-05', 'A'),
(4, 'Carlos Ruiz', 'carlos@example.com', 'carlospass', '2025-03-05', 'E'),
(5, 'Elena Torres', 'elena@example.com', 'torrespass', '2025-03-05', 'A');

-- Mostramos los datos de las tablas
select * from usuarios;
select * from productos;
select * from codigos;

