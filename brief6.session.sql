USE electronacerdb2;
--@block
CREATE TABLE users (
    id INT NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    passw VARCHAR(20) NOT NULL,
    valide BOOLEAN NOT NULL,
    PRIMARY KEY (id)
) 
--@block
CREATE TABLE admins(
    id INT PRIMARY KEY NOT NULL IDENTITY(1,1),
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    passw VARCHAR(20) NOT NULL
    
);
--@block
CREATE TABLE Products (
    reference INT PRIMARY KEY,
    imgs VARCHAR(250),
    productname VARCHAR(255) NOT NULL,
    barcode VARCHAR(10) NOT NULL,
    purchase_price DECIMAL(10, 2) NOT NULL,
    final_price DECIMAL(10, 2) NOT NULL,
    price_offer DECIMAL(10, 2) ,
    descrip TEXT,
    min_quantity INT NOT NULL,
    stock_quantity INT NOT NULL,
    category_name VARCHAR(50),
    FOREIGN KEY (category_name) REFERENCES Categories(catname) ON DELETE CASCADE
);

--@block
CREATE TABLE Categories (
    catname VARCHAR(50) PRIMARY KEY,
    descrip TEXT,
    imgs VARCHAR(250)
);