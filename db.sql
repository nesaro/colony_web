CREATE TABLE IF NOT EXISTS users
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(12) UNIQUE NOT NULL,
    password VARCHAR(12) NOT NULL,
    userlevel INT NOT NULL,
    FOREIGN KEY (userlevel) REFERENCES userlevel(name)
);

CREATE TABLE IF NOT EXISTS websession
(
    websession INT PRIMARY KEY, 
    iduser INT NOT NULL,
    created TIMESTAMP DEFAULT NOW()
);

create TABLE IF NOT EXISTS apprequest
(
    appsession INT PRIMARY KEY,
    app VARCHAR(80) NOT NULL,
    iduser INT NOT NULL,
    tmppath VARCHAR(255)
);

create TABLE IF NOT EXISTS userlevel
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR("12"),
    description TEXT
);

INSERT INTO userlevel ('name','description') VALUES ('Basic','restricted library, ads, no personal space, no fee');
INSERT INTO userlevel ('name','description') VALUES ('Standard','less restricted library, no ads, 10MB personal space, small fee');
INSERT INTO userlevel ('name','description') VALUES ('Premium','full access library, no ads, 1GB personal space, big fee');
