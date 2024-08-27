CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE expenses (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    expense decimal(5,2) NOT NULL,
    date DATE NOT NULL,
    category_id INT NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories(id) 
);