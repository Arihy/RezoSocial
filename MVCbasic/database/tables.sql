-- DROP TABLE users;

CREATE TABLE users (
 
  id               int(10) NOT NULL AUTO_INCREMENT,
  login  varchar(32)  NOT NULL,
  password     char(40)     NOT NULL,
  email    varchar(128) NOT NULL,
  created date NOT     NULL,
 
  PRIMARY KEY (id),
  UNIQUE KEY login (login),
  UNIQUE KEY email (email),
  KEY password (password)
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE relationships (
  id1 int(10) NOT NULL,
  id2 int(10) NOT NULL,
  request_date date NOT NULL,
  acceptation_date date,

  PRIMARY KEY (id1, id2),
  FOREIGN KEY (id1) REFERENCES users(id),
  FOREIGN KEY (id2) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;