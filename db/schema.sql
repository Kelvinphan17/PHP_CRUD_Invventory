CREATE SEQUENCE actions_id_seq
  START WITH 1
  INCREMENT BY 1
  NO MINVALUE
  NO MAXVALUE
  CACHE 1;

CREATE TABLE inventory (
  id integer NOT NULL DEFAULT nextval('actions_id_seq'::regclass),
  product_name varchar(255) NOT NULL,
  item_size decimal,
  style_code varchar(255),
  purchase_price decimal NOT NULL,
  market_price decimal,
  colorway varchar(255),
  purchase_date date,
  product_status int,
  sold_price decimal,
  profit decimal,
  PRIMARY KEY (id)
);