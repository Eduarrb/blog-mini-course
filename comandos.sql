CREATE DATABASE blog_mini;

USE blog_mini

CREATE TABLE categorias(
    cat_id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cat_name VARCHAR(255) NOT NULL
)

INSERT INTO categorias (cat_name) VALUES
    ("PHP"),
    ("HTML"),
    ("MYSQL"),
    ("C#")

CREATE TABLE posts(
    post_id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    post_cat_id INT NOT NULL,
    post_titulo VARCHAR(255) NOT NULL,
    post_user_id INT NOT NULL,
    post_fecha DATE NOT NULL,
    post_img TEXT NOT NULL,
    post_contenido TEXT NOT NULL,
    post_tags VARCHAR(255),
    post_vistas INT,
    post_status VARCHAR(255) NOT NULL
)

INSERT INTO posts (post_cat_id, post_titulo, post_user_id, post_fecha, post_img, post_contenido, post_tags, post_vistas, post_status) VALUES
    (1, "Cusro PHP", 1, "2020-09-03", "01.png", "Lorem ipsum dolor sit amet consectetur adipisicing.", "php, html, curso, verano", 0, "publicado"),
    (6, "Cusro de Javascript", 1, "2020-09-03", "02.png", "Lorem ipsum dolor sit amet consectetur adipisicing.", "javascript, html, curso, verano", 0, "publicado"),
    (2, "Cusro HTML5", 1, "2020-09-03", "03.png", "Lorem ipsum dolor sit amet consectetur adipisicing.", "html, curso, verano", 0, "publicado"),
    (3, "Cusro básico de Base de Datos", 1, "2020-09-03", "04.png", "Lorem ipsum dolor sit amet consectetur adipisicing.", "mysql, curso, verano", 0, "publicado")

CREATE TABLE comentarios(
    com_id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    com_post_id INT NOT NULL,
    com_name VARCHAR(255) NOT NULL,
    com_email VARCHAR(255) NOT NULL,
    com_mensaje TEXT NOT NULL,
    com_status VARCHAR(255) NOT NULL,
    com_fecha DATETIME NOT NULL
)

SELECT * FROM comentarios

SELECT *, year(com_fecha) as anio, month(com_fecha) as mes, day(com_fecha) as dia FROM comentarios
