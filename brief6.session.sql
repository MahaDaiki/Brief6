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
INSERT INTO admins ( username , email ,passw) VALUES
('admin1','admin1@email.com','admin1')
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
    imgs VARCHAR(250),
    bl BOOLEAN 
);

--@block
INSERT INTO categories ( catname , descrip ,imgs, bl) VALUES
    ('Mouse','Gaming Mouse extra buttons, high sensitivity, Wireless ', 'img/catmouse' , 1),
    ('KeyBoards','Gaming Keyboards, Mechanical Keyboards','img/catkeyboards' ,1),
    ('Headsets','Gaming,Wireless,Noise-Canceling Headsets','img/casque' ,1),
    ('Coolers','CPU Coolers with RGB Lighting','img/catcooler',1),
    ('Computers','Gaming,laptops and pcs', 'img/catlaptop&pc',1),
    ('Monitors','Gaming, Ultra-Wide,4k, Curved Monitors','img/catmonitors',1),
    ('SSD','SATA,NVMe,External SSDs', 'img/catssd',1),
    ('RAM','DDR,RGB RAM', 'img/catram',1)


    --@block
INSERT INTO Products ( imgs, productname, barcode, purchase_price, final_price, price_offer, descrip, min_quantity, stock_quantity, category_name) VALUES 
 ('img/ram1.jpg', 'Ram 8gb',235467896, 300, 450, 435 , 'Ram 8gb', 2, 20, 'RAM' ),
    ('img/ram2.jpg', 'Ram',235454896, 350, 450, 393 , 'Ram gb', 2, 20, 'RAM'),
    ('img/ram3.jpg', 'Ram ',231267896, 400, 550, 495 , 'Ram ', 2, 20, 'RAM'),
    ('img/ram4.jpg', 'Ram',235461256, 400, 550, 535, 'Ram ', 2, 15, 'RAM'),
    ('img/ram-ddr4-16gb-2x8gb-pc3000-rgb-cl16.jpg', 'Ram ddr4 16gb',334456478, 474, 625, 450,'Ram ddr4',2,30, 'RAM'),
    ('img/emtec-disque-dur-ssd.jpg','emtec ssd',123986433, 500,700, 600,'EMTEC ssd',2,35,'SSD'),
    ('img/emtec-power--ssd.jpg' ,'emtec power ssd', 3476546584 ,600,500, 450 ,'EMTEC POWER', 2, 2,'SSD'),
    ('img/kingston-25-ssd.jpg','king stone ssd',123456789,500,700,687,'KING STONE',2,1,'SSD'),
    ('img/cooler-master-masterliquid.jpg','cooler',354872873,1000,1500,1232,'liquid cooler',2,2,'Coolers'),
    ('img/thermaltake-floe-dx-water.jpg','thermaltake',984756378,2000,3000,2932,'water cooler',2,1,'Coolers'),
    ('img/gaming-monitor.jpg',' Monitor',127374914,2000,4500,3000,'Gaming monitor',2,5,'Monitors'),
    ('img/monitor-24-msi.jpg',' Monitor',984538765,3000,6000,5242,'MCI MONITOR',2,3,'Monitors'),
    ('img/samsung-24-curvo.jpg','Samsung Monitor',647647382,5000,7000,5202,'Samsung Curvo Monitor',2,1,'Monitors'),
    ('img/gaming-mouse-razer-trinity.jpg','trinity razer mouse ',253984678,500,700,699,'trinity razer gaming',2,3,'Mouse'),
    ('img/gaming-viper-ultimate-razer-mouse.jpg','viper mouse',836476538,700,900,800,'ultimate viper',2,1,'Mouse'),
    ('img/razer-mouse-mamba-elite.jpg','elite mouse',126387645,400,600,599.99,'mamba elite',2,3,'Mouse'),
    ('img/pc1',' Skytech Desktop gaming',2537813654,8000,9500,7000,'Skytech Eclipse Gaming PC Desktop  NVIDIA RTX 4070Ti',2,1,'Computers'),
    ('img/pc2','Desktop Skytech Archangel ',263517357,9000,11000,9500,'Skytech Archangel Gaming Pc NVIDIA RTX 4070 Ti, 1TB',2,3,'Computers'),
    ('img/pc3','Laptop MSI ',263587357,12000,18000,16500,'MSI 144 Hz IPS Intel Core i7 13th Gen',2,10,'Computers'),
    ('img/pc4','Laptop Hasee ',263517357,9000,11000,9500,'Hasee Z8  Gaming Laptop 16G DDR4 RAM',2,1,'Computers'),
    ('img/keyboard1','Keyboard Crosshair', 987356478,1000,2500,2000,'CORSAIR WIRELESSMechanical Gaming Keyboard RGB',2,4,'Keyboards'),
    ('img/keyboard2','Keyboard Rosewill', 987356438,800,1500,1000,'Rosewill NEON RGB Wired Mechanical Gaming Keyboard',2,4,'Keyboards'),
    ('img/keyboard3','Keyboard Neon Rosewill', 987356878,700,1900,1000,'Rosewill NEON Wired Mechanical Gaming Keyboard',2,10,'Keyboards'),
    ('img/c1','White headset',2638465489,800,1000,900,'Wireless headset RGB',2,1,'Headsets'),
    ('img/c2','Black headset',2648465489,900,1200,1000,'Wireless headset RGB',2,5,'Headsets')

