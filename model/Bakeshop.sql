-- User: bakeuser; password: bake

-- create and select the database
DROP DATABASE IF EXISTS Bakeshop;
CREATE DATABASE Bakeshop;
USE Bakeshop;

-- create the tables for the database
CREATE TABLE customers (
  customerID        INT            NOT NULL   AUTO_INCREMENT,
  emailAddress      VARCHAR(255)   NOT NULL,
  password          VARCHAR(60)    NOT NULL,
  shipAddressID     INT                       DEFAULT NULL, 
  PRIMARY KEY (customerID),
  UNIQUE INDEX emailAddress (emailAddress)
);

CREATE TABLE addresses (
  addressID         INT            NOT NULL,
  customerID        INT            NOT NULL,
  line1             VARCHAR(60)    NOT NULL,
  line2             VARCHAR(60)               DEFAULT NULL,
  city              VARCHAR(40)    NOT NULL,
  state             VARCHAR(2)     NOT NULL,
  zipCode           VARCHAR(10)    NOT NULL,
  phone             VARCHAR(12)    NOT NULL,
  PRIMARY KEY (addressID),
  INDEX customerID (customerID)
);

CREATE TABLE orders (
  orderID           INT            NOT NULL  AUTO_INCREMENT,
  customerID        INT            NOT NULL,
  productAmount        DECIMAL(10,2)  NOT NULL,
  shipDate          VARCHAR(10)                  DEFAULT NULL,
  shipAddressID     INT            NOT NULL,
  cardType          CHAR(16)            NOT NULL,
  cardNumber        CHAR(16)       NOT NULL,
  orderDate          DATETIME                  DEFAULT NULL,
  PRIMARY KEY (orderID), 
  INDEX customerID (customerID)
);

CREATE TABLE orderItems (
  itemID            INT            NOT NULL   AUTO_INCREMENT,
  orderID           INT            NOT NULL,
  productID          INT           NOT NULL,
  PRIMARY KEY (itemID), 
  INDEX orderID (orderID)
);

CREATE TABLE cartproduct (
  cartitemID     INT     NOT NULL  AUTO_INCREMENT,
  customerID     INT     NOT NULL,
  productID      INT     NOT NULL,
  productNum     INT     NOT NULL,
   PRIMARY KEY (cartitemID), 
  INDEX customerID (customerID), 
  INDEX productID (productID)
  );


CREATE TABLE products (
  productID         INT            NOT NULL   AUTO_INCREMENT,
  categoryID        INT            NOT NULL,
  productCode       VARCHAR(10)    NOT NULL,
  productName       VARCHAR(255)   NOT NULL,
  description       TEXT           NOT NULL,
  listPrice         DECIMAL(10,2)  NOT NULL,
  discountPercent   DECIMAL(10,2)  NOT NULL   DEFAULT 0.00,
  PRIMARY KEY (productID), 
  INDEX categoryID (categoryID), 
  UNIQUE INDEX productCode (productCode)
);

CREATE TABLE categories (
  categoryID        INT            NOT NULL   AUTO_INCREMENT,
  categoryName      VARCHAR(255)   NOT NULL,
  PRIMARY KEY (categoryID)
);

CREATE TABLE administrators (
  adminID           INT            NOT NULL   AUTO_INCREMENT,
  emailAddress      VARCHAR(255)   NOT NULL,
  password          VARCHAR(255)   NOT NULL,
  firstName         VARCHAR(255)   NOT NULL,
  lastName          VARCHAR(255)   NOT NULL,
  PRIMARY KEY (adminID)
);


-- Insert data into the tables
INSERT INTO categories (categoryID, categoryName) VALUES
(1, 'Cupcake'),
(2, 'Birthday cake'),
(3, 'Homemade cookie'),
(4, 'Coffee cake'),
(5, 'Wedding cake'),
(6, 'Halloween cake'),
(7, 'Christmas cake'),
(8, 'Fruite cake'),
(9, 'Candy'),
(10, 'Brownie'),
(11, 'Daily Special');


INSERT INTO products (productID, categoryID, productCode, productName, description, listPrice, discountPercent) VALUES
(1,1,'ety6','Chocolate Coconut','Valrhona chocolate cupcake with a vanilla 
cream cheese frosting capped with a cloud of shredded coconut','7.80','20'),
(2,1,'cu3','Strawberry','Classic madagascar bourbon vanilla cupcake baked with fresh strawberries and topped with a fresh strawberry frosting and a fondant heart','8.90','10'),
(3,2,'b23','Chocolate Torte','Chocolate or gold cake, chocolate mousseor white chocolate mousses','38.00','5'),
(4,2,'ve3','Black Forest Torte','Chocolate cake, whipped cream, cherries & chocolate,cherry liquor','45.70','5'),
(5,3,'e3','Cookies','Milk chocolate, peanut butter with white chocolate and cashews, white chocolate chunk with pistachio nuts','1.95','0'),
(6,3,'23de','Assorted Bars and Brownies','Chocolate fudge brownie with butterscotch chips and pecans, lemon squares, cheese cheesecake bar, and German chocolate brownie','3.5','0'),
(7,3,'d32','cheesecake slices','Apple cheesecake with gingerbread crust, weekly bakers specials','4.99','0'),
(8,3,'d21','Hand-dipped Assorted Truffles','Mocha, Mint, Grand Marnier,Rum, and raspbery','2.00','0'),
(9,8,'a23','Apple Cake','Apple cake is a popular dessert produced with the main ingredient of apples.','24.96','15'),
(10,8,'a24','Blackberry Cake','A delicious blackberry cake or coffee cake with butter and a crumbly brown sugar topping. Serve this cake for brunch or breakfast ','42.00','0'),
(11,4,'r5','Coffee Cake','a common cake or sweet bread available in many countries.','35.99','0'),
(12,5,'tt1','White wedding cake','Vanilla Cream with Jam of your Choice','132.00','10'),
(13,5,'g32','Lemon wedding cake','Light and refreshing, this four four-layer yellow sponge torte is a year-round favorite. Its filled with a tangy, fresh lemon custard and iced with smooth','134.99','5'),
(14,5,'y21','Bavarian Cream Raspberry wedding cake','This cake consists of two layers of fine vanilla sponge cake, two layers of thinly sliced chocolate cake filled with hazelnut buttercream and two layers of silky','232.00','8'),
(15,6,'ok3','Jack-o-Lantern Cake','containers (1 lb each) Betty Crocker Rich & Creamy vanilla frosting Yellow and red food color','124.96','15'),
(16,6,'uj4','Pull-Apart Spiderweb Cupcakes','containers Betty Crocker Whipped fluffy white frosting','42.00','14'),
(17,7,'rd5','Classical Christmas cake','This cake is a rich, dark, moist fruit cake, very flavorful at Christmas. Try icing with almond paste for a more festive touch.','235.99','0'),
(18,9,'cf3','Fruite Candy','including marshmallows and gummi bears, contain gelatin derived from animal collagen, a protein found in skin and bones','14.96','15'),
(19,10,'hs5','Best Brownie','To make the brownies rich and buttery, use melted butter instead of the vegetable oil ','22.80','0'),
(20,11,'jt7','Key Lime Cupcake','Fresh key lime cupcake with a key lime frosting topped with a candied lime','35.29','6'),
(21,11,'lno','Mother s Day cupcake','Valrhona chocolate cupcake with vanilla buttercream and a lavender MOM heart fondant','26.00','10');



INSERT INTO customers(customerID, emailAddress, password, shipAddressID) VALUES
(1, 'jiaruihu@bu.edu', '202cb962ac59075b964b07152d234b70' , 1),
(2, 'annhjr@sohu.com', '202cb962ac59075b964b07152d234b70' , 2),
(3, 'Alex@usc.edu', '202cb962ac59075b964b07152d234b70' , 3);

INSERT INTO addresses(addressID, customerID, line1, line2, city, state, zipCode, phone) VALUES
(1, 1, '333street','qwedw avenue','Boston','MA','23232','2421321-12312'),
(2, 2, '333street','qwedw avenue','Boston','MA','23232','2421321-12312'),
(3, 3, '333street','qwedw avenue','Boston','MA','23232','2421321-12312');
 

-- Create a user named mgs_user
GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO bakeuser@localhost
IDENTIFIED BY 'bake';