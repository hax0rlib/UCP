CREATE TABLE IF NOT EXISTS ( id INT(11) NOT NULL AUTO_INCREMENT,
                                                 name VARCHAR(24) NOT NULL,
                                                                  password VARCHAR(32) NOT NULL,
                                                                                       kills INT(11) NOT NULL DEFAULT '0',
                                                                                                                      deaths INT(11) NOT NULL DEFAULT '0',
                                                                                                                                                      score INT(11) NOT NULL DEFAULT '0',
                                                                                                                                                                                     skin INT(11) NOT NULL,
                                                                                                                                                                                                  money INT(11) NOT NULL DEFAULT '5000',
PRIMARY KEY(id),
        UNIQUE KEY(id)) COMMENT = 'Informações dos jogadores do servidor.';

