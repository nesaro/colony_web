CREATE TABLE IF NOT EXISTS users
{
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(12) NOT NULL
};

CREATE TABLE IF NOT EXISTS websession
{
    websession INT PRIMARY KEY, 
    iduser INT NOT NULL
};

create TABLE IF NOT EXISTS apprequest
{
    appsession INT PRIMARY KEY,
    iduser INT NOT NULL
};
