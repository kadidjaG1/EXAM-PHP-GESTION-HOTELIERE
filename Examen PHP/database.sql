CREATE TABLE reservations (

    id SERIAL PRIMARY KEY,

    nom_client VARCHAR(150) NOT NULL,

    numero_chambre INT NOT NULL,

    nombre_nuits INT NOT NULL,

    type_chambre VARCHAR(20)
        CHECK (type_chambre IN ('STANDARD','CONFORT','SUITE')),

    statut VARCHAR(20)
        DEFAULT 'VALIDEE'
        CHECK (statut IN ('VALIDEE','ANNULEE'))

);