USE mosushi;

INSERT INTO categoria (nombre) VALUES ('Entrantes');
INSERT INTO categoria (nombre) VALUES ('Postres');
INSERT INTO categoria (nombre) VALUES ('Bebidas');


INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Norwego','salmon,aguacate,crema de queso envuelto con mango tobiko y teriyaki', 7.70, 1);
INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Fry atun','atun, aguacate, pimiento rojo y queso emmental conteriyaki y mayonesa coktail', 8.70, 1);
INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Futumaki vegetal','lechuga, mango, aguacate, tomate, y pepino', 5.40, 1);

INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Mochi (4uds)','Mochis congelados de diferentes sabores', 5.00, 2);
INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Banana Roll','Banana Roll con nutella y caramelo', 5.50, 2);

INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Cocacola 330ml','Lata de cocacola de 330 mililitros', 1.00, 3);
INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Fanta 330ml','Lata de fanta de 330 mililitros', 1.00, 3);
INSERT INTO producto (nombre, descr, precio, idCat) VALUES ('Agua 500ml','Botella de agua de 500 mililitros', 1.00, 3);

