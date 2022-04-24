CREATE TABLE IF NOT EXISTS `micaelandrade`.`uso_usuario`
(
    `uso_id`                 INT         NOT NULL AUTO_INCREMENT,
    `uso_senha`              VARCHAR(45) NOT NULL,
    `uso_ativo`              TINYINT     NOT NULL,
    `uso_perfil`             TINYINT     NOT NULL,
    `uso_data_cadastro`      DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    `uso_login`              VARCHAR(90) NOT NULL,
    `uso_ultima_atualizacao` DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    `uso_nome`               VARCHAR(45) NOT NULL,
    `uso_data_nascimento`    DATETIME    NULL,
    PRIMARY KEY (`uso_id`),
    UNIQUE INDEX `uso_login_UNIQUE` (`uso_login` ASC) VISIBLE
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `micaelandrade`.`cro_cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `micaelandrade`.`cro_cargo`
(
    `cro_id`                INT         NOT NULL AUTO_INCREMENT,
    `cro_nome`              VARCHAR(90) NOT NULL,
    `clo_utima_atualizacao` DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    `cro_data_cadastro`     DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`cro_id`)
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `micaelandrade`.`ema_empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `micaelandrade`.`ema_empresa`
(
    `ema_id`                INT         NOT NULL AUTO_INCREMENT,
    `ema_nome`              VARCHAR(90) NOT NULL,
    `ema_data_cadastro`     DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ema_utima_atualizacao` DATETIME    NULL     DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ema_id`)
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `micaelandrade`.`sto_situacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `micaelandrade`.`sto_situacao`
(
    `sto_id`                INT         NOT NULL AUTO_INCREMENT,
    `sto_nome`              VARCHAR(90) NOT NULL,
    `sto_utima_atualizacao` DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    `sto_data_cadastro`     DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`sto_id`)
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `micaelandrade`.`flo_filiado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `micaelandrade`.`flo_filiado`
(
    `flo_id`                INT         NOT NULL AUTO_INCREMENT,
    `flo_nome`              VARCHAR(90) NOT NULL,
    `flo_cpf`               VARCHAR(11) NOT NULL UNIQUE ,
    `flo_rg`                VARCHAR(15) NOT NULL,
    `flo_nascimento`        DATETIME    NOT NULL,
    `flo_telefone`          VARCHAR(45) NULL,
    `flo_celular`           VARCHAR(45) NOT NULL,
    `flo_utima_atualizacao` DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    `uso_usuario_uso_id`    INT         NULL,
    `cro_cargo_id`          INT         NULL,
    `ema_empresa_id`        INT         NULL,
    `sto_situacao_id`       INT         NULL,
    `flo_data_cadastro`     DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`flo_id`),
    INDEX `fk_flo_filiado_uso_usuario1_idx` (`uso_usuario_uso_id` ASC) VISIBLE,
    INDEX `fk_flo_filiado_cro_cargo1_idx` (`cro_cargo_id` ASC) VISIBLE,
    INDEX `fk_flo_filiado_ema_empresa1_idx` (`ema_empresa_id` ASC) VISIBLE,
    INDEX `fk_flo_filiado_sto_situacao1_idx` (`sto_situacao_id` ASC) VISIBLE,
    CONSTRAINT `fk_flo_uso1`
        FOREIGN KEY (`uso_usuario_uso_id`)
            REFERENCES `micaelandrade`.`uso_usuario` (`uso_id`)
            ON DELETE SET NULL
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_flo_cro1`
        FOREIGN KEY (`cro_cargo_id`)
            REFERENCES `micaelandrade`.`cro_cargo` (`cro_id`)
            ON DELETE SET NULL
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_flo_ema1`
        FOREIGN KEY (`ema_empresa_id`)
            REFERENCES `micaelandrade`.`ema_empresa` (`ema_id`)
            ON DELETE SET NULL
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_flo_sto1`
        FOREIGN KEY (`sto_situacao_id`)
            REFERENCES `micaelandrade`.`sto_situacao` (`sto_id`)
            ON DELETE SET NULL
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `micaelandrade`.`dps_dependentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `micaelandrade`.`dps_dependentes`
(
    `dps_id`                 INT         NOT NULL AUTO_INCREMENT,
    `dps_nome`               VARCHAR(90) NOT NULL,
    `dps_nascimento`         DATETIME    NOT NULL,
    `dps_grau_parentesco`    TINYINT     NOT NULL,
    `flo_id`                 INT         NOT NULL,
    `dps_data_cadastro`      DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    `dps_ultima_atualizacao` DATETIME    NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`dps_id`),
    INDEX `fk_dps_dependentes_flo_filiado_idx` (`flo_id` ASC) VISIBLE,
    CONSTRAINT `fk_dps_dependentes_flo_filiado1`
        FOREIGN KEY (`flo_id`)
            REFERENCES `micaelandrade`.`flo_filiado` (`flo_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
);

# Populando usários
INSERT INTO `uso_usuario` (`uso_senha`, `uso_ativo`, `uso_perfil`, `uso_login`, `uso_nome`, `uso_data_nascimento`)
VALUES ("MWIRH123", 0, 1, "jkrc", "Mona", "1995/12/26"),
       ("VFUCO123", 0, 2, "prqx", "Zeph", "1976/8/20"),
       ("FPVTO123", 0, 2, "wsga", "Keely", "1989/8/3"),
       ("FPPHO123", 1, 2, "pced", "Rudyard", "1961/5/24"),
       ("UKYXP123", 1, 2, "ofqe", "Karina", "1998/6/20"),
       ("KHDHK123", 0, 2, "xyrh", "Burke", "1966/7/31"),
       ("ZUGOF123", 1, 1, "tmlf", "Damian", "1975/3/15"),
       ("TAFHQ123", 0, 1, "xknc", "Kermit", "1977/5/16"),
       ("HNWVW123", 0, 1, "koif", "Indira", "1969/11/7"),
       ("PQRUJ123", 1, 2, "ojbc", "Xavier", "1961/6/9");
INSERT INTO `uso_usuario` (`uso_senha`, `uso_ativo`, `uso_perfil`, `uso_login`, `uso_nome`, `uso_data_nascimento`)
VALUES ("ELXRY123", 1, 1, "dojw", "Dale", "1964/8/8"),
       ("CBRYT123", 0, 2, "mcii", "Shana", "1998/8/30"),
       ("ORRJW123", 1, 1, "irgl", "Cullen", "1974/9/21"),
       ("NFPOW123", 1, 2, "enod", "Xantha", "1966/6/16"),
       ("YCRLR123", 0, 2, "qtjh", "Shelby", "1983/3/12"),
       ("KRLGS123", 1, 2, "abjp", "Wynne", "1975/12/19"),
       ("UJLMH123", 1, 2, "xkxv", "Flynn", "1996/8/16"),
       ("TPLNT123", 0, 2, "sqxi", "Tashya", "1999/11/16"),
       ("IEBDN123", 1, 1, "rdww", "Alfonso", "1967/5/4"),
       ("IEOAU123", 1, 1, "lewe", "Ulysses", "1989/5/10");
INSERT INTO `uso_usuario` (`uso_senha`, `uso_ativo`, `uso_perfil`, `uso_login`, `uso_nome`, `uso_data_nascimento`)
VALUES ("BIMCI123", 0, 2, "setm", "Kevin", "1967/8/24"),
       ("JHXXF123", 0, 2, "ndxh", "Lars", "1978/3/20"),
       ("OTDFM123", 0, 2, "uwhi", "Elvis", "1995/11/8"),
       ("PITTJ123", 1, 1, "tskl", "Adele", "1990/11/24"),
       ("LJURY123", 1, 1, "kgfd", "Tanya", "1995/5/21"),
       ("KCELJ123", 1, 2, "dqrx", "Addison", "1963/1/25"),
       ("FRHGB123", 1, 2, "pgsg", "Julian", "1980/4/13"),
       ("ORUJR123", 0, 1, "qivv", "Gregory", "1982/6/11"),
       ("EOWET123", 1, 1, "lbli", "Yolanda", "1969/8/25"),
       ("VKCMP123", 0, 1, "ofxm", "Blaze", "1967/11/4");
INSERT INTO `uso_usuario` (`uso_senha`, `uso_ativo`, `uso_perfil`, `uso_login`, `uso_nome`, `uso_data_nascimento`)
VALUES ("MPLKD123", 1, 1, "uqgr", "Palmer", "1969/6/21"),
       ("MBTLJ123", 0, 2, "bxnr", "Delilah", "1999/10/15"),
       ("TKCGX123", 1, 1, "uxul", "Malik", "1983/9/30"),
       ("WDIIU123", 0, 2, "kfsr", "Teegan", "1974/3/29"),
       ("YBZKR123", 1, 1, "ffxq", "Zachery", "1974/6/21"),
       ("DLGFT123", 0, 1, "cxhm", "Christopher", "1982/7/24"),
       ("MMCMG123", 1, 2, "fdjk", "Dale", "1970/7/4"),
       ("NONJG123", 0, 1, "csnm", "Buckminster", "1996/4/9"),
       ("IDGWV123", 0, 1, "lnsc", "Helen", "1963/8/31"),
       ("HJMPO123", 1, 2, "likb", "Willow", "1966/12/17");
INSERT INTO `uso_usuario` (`uso_senha`, `uso_ativo`, `uso_perfil`, `uso_login`, `uso_nome`, `uso_data_nascimento`)
VALUES ("IVDBH123", 0, 1, "kbrh", "Belle", "1988/12/5"),
       ("THPTT123", 1, 2, "boat", "Travis", "1972/10/23"),
       ("GSTIM123", 1, 2, "ftby", "Angelica", "1999/8/16"),
       ("JOJGQ123", 0, 2, "mzwn", "Barrett", "1966/10/30"),
       ("KBFFH123", 1, 2, "qlra", "Davis", "1969/11/28"),
       ("LPLBD123", 1, 1, "nufy", "Donovan", "1990/6/16"),
       ("CANGW123", 1, 2, "yysk", "Galvin", "1984/4/3"),
       ("LESQL123", 1, 1, "gbne", "Wade", "1987/4/8"),
       ("QMIEN123", 1, 2, "nxxx", "Lionel", "1998/10/9"),
       ("WXPXR123", 0, 2, "kaae", "Lance", "1991/1/17");
INSERT INTO `uso_usuario` (`uso_senha`, `uso_ativo`, `uso_perfil`, `uso_login`, `uso_nome`, `uso_data_nascimento`)
VALUES ("IKAFT123", 1, 2, "kkrw", "Lois", "1965/4/21"),
       ("IDQJG123", 1, 2, "kqcw", "Colt", "1998/2/4"),
       ("ZVMYN123", 1, 2, "btlc", "Driscoll", "1978/4/13"),
       ("XLFUK123", 0, 1, "eyge", "Ivan", "1966/10/13"),
       ("ZQGRB123", 0, 2, "pivb", "Lara", "1992/6/22"),
       ("IWGUH123", 0, 1, "dsvt", "Aristotle", "1995/11/12"),
       ("NSLSA123", 1, 1, "qdbm", "Lawrence", "1967/8/4"),
       ("OTIMQ123", 1, 2, "ehci", "Hyacinth", "1971/10/8"),
       ("MYNKC123", 0, 2, "puci", "Ria", "1962/3/3"),
       ("TGUHS123", 1, 2, "hxyx", "Zahir", "1997/12/10");
INSERT INTO `uso_usuario` (`uso_senha`, `uso_ativo`, `uso_perfil`, `uso_login`, `uso_nome`, `uso_data_nascimento`)
VALUES ("AQRDU123", 0, 1, "ebyf", "Guy", "1975/12/27"),
       ("WXOBS123", 1, 1, "zcuu", "Clarke", "1970/2/6"),
       ("UGSKJ123", 1, 1, "okry", "Salvador", "1974/10/11"),
       ("ULHLO123", 0, 2, "xsqu", "Dominique", "1961/3/26"),
       ("IQMML123", 1, 2, "xpcm", "Lamar", "1975/11/21"),
       ("FHIJY123", 1, 1, "bdkp", "Harriet", "1979/10/23"),
       ("BKKPF123", 0, 1, "ttdn", "Susan", "1975/6/11"),
       ("OELRB123", 1, 1, "zlnw", "Kibo", "1986/5/31"),
       ("BVVLC123", 1, 1, "wppo", "Savannah", "1995/4/19"),
       ("FJWTN123", 1, 1, "luro", "Evan", "1989/5/8");

# Empresas
INSERT INTO `ema_empresa` (`ema_nome`)
VALUES ("Mi Tempor Ltd"),
       ("Erat Semper Inc."),
       ("Nisi Dictum Augue Ltd"),
       ("Ultrices Sit Incorporated"),
       ("Vestibulum Nec Industries"),
       ("Lectus Sit Industries"),
       ("Etiam Limited"),
       ("Consequat Lectus Incorporated"),
       ("A Malesuada Inc."),
       ("Cursus Luctus Ipsum Consulting");
INSERT INTO `ema_empresa` (`ema_nome`)
VALUES ("Est Tempor PC"),
       ("Eu LLC"),
       ("Ac Sem Ut Limited"),
       ("Tellus Inc."),
       ("Fermentum Risus Industries"),
       ("Posuere Cubilia Ltd")
;

# Cargo
INSERT INTO `cro_cargo` (`cro_nome`)
VALUES ("Gerente de Trainee"),
       ("Gerente de Projetos"),
       ("Estagiário"),
       ("Diretor")
;
# Cargo
INSERT INTO `sto_situacao` (`sto_nome`)
VALUES ("Aposentado"),
       ("Licença"),
       ("Afastado")
;
# add Filliados
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Angelica Sexton", 56502079156, "1983/5/28", "6746417736", "3843823076", 38, 3, 2, 1, "19251451"),
       ("Lee Olsen", 79788899762, "1995/8/18", "2365626581", "6929853708", 62, 2, 1, 6, "43852350"),
       ("Cheyenne Rosa", 67864438447, "1977/3/3", "8375667047", "7568553550", 30, 2, 2, 11, "22142439"),
       ("Colton Fisher", 44365315525, "1996/2/3", "7368885119", "6232449184", 27, 1, 2, 14, "34346763"),
       ("Charles Farley", 36434045764, "1994/11/13", "0629916447", "5416444274", 44, 1, 2, 2, "18328142"),
       ("Victoria Lynch", 66480147264, "1996/12/28", "3344855268", "7356489583", 24, 2, 3, 2, "57255503"),
       ("Pascale Ewing", 38371803301, "1976/7/16", "5855689107", "1384719489", 24, 3, 2, 4, "38325474"),
       ("Lilah Barker", 92800864618, "1987/2/14", "6584826054", "6372687428", 31, 3, 2, 12, "61896491"),
       ("Karen Oneil", 89959541021, "1975/3/15", "1943837979", "8172530268", 4, 1, 1, 13, "26160539"),
       ("Garth Romero", 74683711783, "1977/1/8", "5452775673", "9398765165", 40, 4, 2, 6, "87274116");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Nash Schmidt", 47884234778, "1999/6/4", "5295523835", "2483913153", 55, 2, 2, 10, "84437628"),
       ("Athena Forbes", 75826185066, "1981/1/31", "1686172977", "5215084622", 16, 4, 2, 2, "42284276"),
       ("Ginger Cantrell", 82737663764, "1998/8/25", "7783595266", "3453722182", 16, 2, 2, 2, "22312305"),
       ("Jerome Todd", 65606722037, "1956/4/22", "2089626534", "3725873471", 7, 4, 2, 10, "48182152"),
       ("Tucker Knowles", 62831553285, "1964/9/11", "4195944138", "7830767450", 27, 2, 3, 14, "32353607"),
       ("Merritt Holder", 82396198680, "1979/10/9", "5621797763", "8751569371", 37, 2, 2, 3, "32224075"),
       ("Ashely Ryan", 23003879099, "1993/2/17", "4584960216", "8823356587", 21, 1, 2, 7, "82139057"),
       ("Carol Morgan", 42871045847, "1957/6/11", "8330855754", "0902678472", 43, 3, 2, 15, "01468015"),
       ("Lillith Frederick", 76839627105, "1985/6/17", "1334843077", "2386386284", 63, 3, 1, 8, "68840836"),
       ("Karleigh Christian", 66449037275, "1966/1/12", "6548727977", "4736361035", 39, 3, 2, 14, "01692731");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Germaine Turner", 44232080490, "2000/4/7", "4436167710", "7514723573", 60, 2, 2, 9, "86645305"),
       ("Quynn Winters", 86307824804, "1972/4/21", "5449517681", "3208512638", 36, 3, 1, 3, "71212134"),
       ("Lenore Wong", 32810858774, "1986/6/13", "0175916463", "5081254133", 26, 3, 3, 16, "08773536"),
       ("Tarik Cote", 23552121172, "1967/10/21", "5302323138", "2751648062", 14, 4, 3, 5, "92718674"),
       ("Sydney Burton", 79802399828, "1994/12/29", "5174847775", "7289666103", 23, 3, 2, 15, "03894251"),
       ("Abdul Walls", 77505674091, "1953/6/9", "4487476326", "8554725856", 51, 1, 3, 7, "07864423"),
       ("Quemby Barton", 30530926685, "1971/3/30", "7156306624", "3512878154", 46, 3, 2, 10, "82321441"),
       ("Sasha Powers", 96577992013, "1974/1/15", "1889285871", "5523243582", 56, 4, 1, 14, "67424744"),
       ("Norman Tran", 86396917321, "1986/3/12", "6314617153", "5353071253", 31, 2, 2, 8, "97137877"),
       ("Alice Lamb", 21370833897, "1958/7/4", "7950656641", "3763477834", 20, 3, 3, 3, "83753121");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Shaeleigh Rodriquez", 79522251512, "1996/7/6", "5188070469", "8757486259", 61, 3, 3, 11, "51943783"),
       ("Ira Allison", 41513135950, "1955/3/11", "6324331316", "8232811533", 65, 2, 3, 9, "50580035"),
       ("Rahim Guthrie", 27548434020, "1962/12/27", "3161585499", "6422303878", 64, 2, 1, 11, "10653119"),
       ("Barbara Chang", 81793078668, "1988/5/8", "8122819182", "4324987288", 33, 2, 2, 1, "74343744"),
       ("Orlando Fleming", 22466232266, "1953/11/17", "6165683573", "6195515856", 16, 2, 2, 8, "16178711"),
       ("Christen O'donnell", 87655670047, "1972/10/31", "2162143363", "8941271876", 47, 3, 2, 2, "22711681"),
       ("Candice Bridges", 27688933451, "1971/2/26", "7445835685", "6309157443", 34, 4, 2, 15, "66787135"),
       ("Victor Bridges", 20298251501, "1972/12/5", "3847585765", "6455264666", 60, 4, 2, 5, "77937882"),
       ("Jason Greene", 33375726516, "1989/3/4", "4506921751", "4284167556", 43, 4, 2, 9, "06232072"),
       ("Benjamin Harmon", 65523034395, "1987/10/25", "8862247827", "0273291771", 32, 3, 2, 5, "44447132");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Francis Kidd", 50099206374, "1980/11/10", "1250881872", "5255628656", 69, 3, 2, 13, "62026026"),
       ("Whoopi Coleman", 95047859526, "1969/10/19", "3108851153", "7532555372", 24, 1, 2, 15, "74317583"),
       ("Hilary Fitzgerald", 20193466225, "1958/9/4", "5433148153", "9417381281", 31, 3, 2, 6, "62893206"),
       ("Mary Reyes", 39307409271, "1989/4/7", "2086120489", "7373276472", 45, 1, 2, 5, "10227763"),
       ("Neil Bullock", 54678548789, "1988/7/1", "8557560366", "2026498456", 1, 2, 3, 16, "18248635"),
       ("Lydia Hanson", 45575041134, "1955/9/7", "3128834004", "5340611447", 3, 3, 3, 11, "57428178"),
       ("Kasper Jenkins", 18921155774, "1993/5/19", "0204418688", "3954815588", 59, 3, 2, 8, "17781448"),
       ("Blaze Slater", 88719921024, "1995/2/3", "8760105578", "7159326284", 34, 2, 1, 8, "23050457"),
       ("Upton Henderson", 23143962297, "1974/1/6", "6171642833", "9535146927", 9, 3, 2, 2, "95583866"),
       ("Uriel Buckley", 42967732244, "1985/8/7", "5478182482", "9630958755", 20, 2, 3, 11, "43796612");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Erasmus Walters", 80581903788, "1977/2/6", "6555421514", "1295362481", 69, 2, 3, 11, "22673898"),
       ("Olivia Rodriquez", 93643524858, "1960/6/10", "4358389547", "8992493191", 9, 4, 1, 4, "10572176"),
       ("Gay Schultz", 91600130194, "1952/4/28", "3467890144", "1679932024", 44, 2, 2, 8, "16913241"),
       ("Fulton Swanson", 37865845968, "1963/9/1", "9728545383", "4033991855", 66, 1, 1, 6, "43324581"),
       ("Leilani Silva", 12778074708, "1962/9/11", "4378853312", "4782464257", 31, 4, 1, 11, "78553953"),
       ("Ina Rodgers", 94903683933, "1983/8/31", "0160238157", "3447310348", 63, 3, 2, 15, "48021756"),
       ("Louis Lambert", 83254679197, "1993/4/6", "6275216396", "4732761820", 27, 3, 2, 3, "40754169"),
       ("Mikayla Mcfadden", 98026787054, "1970/1/1", "8482396258", "9159076247", 13, 1, 1, 14, "82564451"),
       ("Rebecca Mcfarland", 38022089374, "1962/1/14", "6847288621", "5238295442", 44, 2, 1, 15, "29887167"),
       ("Kyla Stanley", 38125807647, "1955/9/29", "2740325934", "1924335455", 69, 1, 3, 15, "76737568");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Eve Mcpherson", 31293900991, "1964/8/14", "7436711789", "5337810813", 15, 1, 2, 10, "17298648"),
       ("Christopher Wallace", 59963549218, "1997/7/12", "5816411325", "3828618774", 27, 1, 2, 12, "88918587"),
       ("Vivien Spence", 45548721029, "1988/3/5", "0059623980", "2240256143", 42, 2, 2, 10, "74448175"),
       ("Leah Beard", 78995949643, "1959/7/15", "7167803384", "8935958145", 17, 1, 2, 2, "67252731"),
       ("Caesar Madden", 92880917818, "1962/5/7", "9385448052", "1975518731", 28, 2, 3, 16, "69279411"),
       ("Dexter Maynard", 68081884560, "1987/10/14", "4601636918", "0745752257", 20, 3, 2, 2, "94528227"),
       ("Suki Bishop", 38160005677, "1964/8/1", "2666155825", "8375381443", 28, 3, 3, 8, "17464824"),
       ("Isabelle Finch", 23074125021, "1987/10/14", "3684561335", "7476224536", 62, 3, 2, 13, "54617833"),
       ("Clare Rasmussen", 92212576979, "1963/3/17", "4157738812", "1130338299", 45, 2, 1, 1, "68989644"),
       ("Zahir Garner", 36627603303, "1952/6/6", "3942174073", "4742517226", 42, 2, 1, 6, "74147508");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Tashya Gallegos", 69465393078, "1961/4/14", "2446768272", "7795286536", 18, 4, 2, 12, "27714556"),
       ("Bryar Booth", 34892544228, "1957/5/31", "5889122593", "2618932333", 16, 3, 3, 13, "31351560"),
       ("Duncan Clarke", 52678175075, "1977/8/23", "8665756441", "4339154397", 70, 3, 3, 7, "01012113"),
       ("Aline Pace", 68619611838, "1989/2/18", "7371415561", "9358747815", 32, 2, 3, 6, "18367619"),
       ("Jolie Nash", 28249057485, "1985/2/5", "7645168757", "1318023843", 65, 3, 2, 12, "24524549"),
       ("Richard Walton", 24372577382, "1985/2/20", "9575110397", "1453641551", 41, 2, 1, 7, "32493403"),
       ("Amos Lang", 61885037664, "1984/6/21", "4656338731", "7962684494", 56, 2, 2, 5, "12342726"),
       ("Shea Dunn", 98823060733, "1993/11/22", "6244410776", "4783201878", 5, 2, 1, 7, "38642934"),
       ("Kitra Dale", 18100425055, "1988/10/10", "3335878516", "6513250856", 66, 3, 2, 14, "81764247"),
       ("Catherine Barlow", 88871312189, "1986/3/24", "2898065271", "2843800276", 9, 2, 1, 8, "65796474");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Sawyer Murphy", 98747567465, "1980/5/17", "3156537866", "3733531334", 51, 2, 2, 13, "18027411"),
       ("Caryn Mccray", 51008721697, "1982/1/27", "8013788548", "7856384122", 16, 2, 2, 3, "71487877"),
       ("Reese Molina", 58323543423, "1997/4/11", "2311877627", "3431926666", 52, 4, 2, 6, "22169284"),
       ("Kenneth Aguirre", 18288251324, "1996/7/29", "1287916676", "4311054990", 38, 2, 2, 2, "03246575"),
       ("Gavin Rowe", 80279134295, "1962/9/23", "2627115482", "1121756510", 17, 2, 2, 6, "52516263"),
       ("Zelda Rice", 82033409935, "1954/5/6", "5632562558", "3557711588", 22, 3, 3, 3, "10867134"),
       ("Conan Clemons", 12086421897, "1993/11/1", "0211917821", "1581665629", 27, 2, 2, 4, "38836515"),
       ("Colby Horn", 19584578690, "1972/10/8", "7291972529", "6327157754", 27, 1, 2, 5, "83116817"),
       ("Ori Hardin", 82499807427, "1974/10/16", "1616771747", "6586534038", 55, 2, 2, 4, "74934609"),
       ("Galena Andrews", 41146532549, "1997/10/9", "1258553357", "6166545339", 9, 4, 2, 2, "83338756");
INSERT INTO flo_filiado (flo_nome, flo_cpf, flo_nascimento, flo_telefone, flo_celular, uso_usuario_uso_id, cro_cargo_id,
                         sto_situacao_id, ema_empresa_id, flo_rg)
VALUES ("Joshua Mcleod", 20039531041, "1995/12/23", "7274977782", "4891933855", 40, 4, 3, 6, "92436611"),
       ("Fletcher Mcconnell", 90255211645, "1961/11/17", "8564567216", "2514580445", 10, 3, 2, 2, "67281111"),
       ("Ezekiel Hines", 94437257169, "1993/5/26", "8761122325", "0140134412", 7, 3, 3, 11, "28455680"),
       ("Cole Ortega", 27055755357, "1959/7/15", "4487344168", "1362297556", 16, 4, 1, 16, "42294332"),
       ("Oren Rodriguez", 83441120511, "1965/3/22", "6734818045", "1784892100", 63, 2, 1, 15, "68741533"),
       ("Melodie Waller", 63589482038, "1962/10/3", "4555512889", "4855121174", 25, 1, 3, 6, "39108705"),
       ("Scarlet Burke", 17570534408, "1957/1/3", "8498777942", "1885599425", 30, 1, 3, 13, "57916716"),
       ("Ross Baldwin", 91806474084, "1996/11/5", "2236781912", "2466454167", 6, 2, 2, 5, "32939578"),
       ("Murphy Clarke", 97158207853, "1986/10/30", "1565878662", "8645118345", 56, 2, 1, 15, "54288266"),
       ("Rhonda Pacheco", 54712748133, "1977/2/7", "6558265643", "5839919183", 29, 2, 3, 7, "21274884");

INSERT INTO uso_usuario (uso_nome, uso_senha, uso_ativo, uso_login, uso_perfil)
VALUES ('marcos', '123456', 1, 'admin', 1);