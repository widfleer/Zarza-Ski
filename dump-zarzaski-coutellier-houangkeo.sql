--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.19
-- Dumped by pg_dump version 13.8 (Debian 13.8-0+deb11u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: projet; Type: SCHEMA; Schema: -; Owner: loelia.coutellier
--

CREATE SCHEMA projet;


ALTER SCHEMA projet OWNER TO "loelia.coutellier";

--
-- Name: code_niveau_pref; Type: TYPE; Schema: projet; Owner: loelia.coutellier
--

CREATE TYPE projet.code_niveau_pref AS ENUM (
    '1',
    '2',
    '3',
    '4'
);


ALTER TYPE projet.code_niveau_pref OWNER TO "loelia.coutellier";

--
-- Name: niveau_client; Type: TYPE; Schema: projet; Owner: loelia.coutellier
--

CREATE TYPE projet.niveau_client AS ENUM (
    'débutant',
    'moyen',
    'confirmé'
);


ALTER TYPE projet.niveau_client OWNER TO "loelia.coutellier";

--
-- Name: vue_chambre; Type: TYPE; Schema: projet; Owner: loelia.coutellier
--

CREATE TYPE projet.vue_chambre AS ENUM (
    'parking',
    'pistes'
);


ALTER TYPE projet.vue_chambre OWNER TO "loelia.coutellier";

SET default_tablespace = '';

--
-- Name: sae_achete; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_achete (
    num_client integer NOT NULL,
    nom_formule character varying(12) NOT NULL,
    num_res integer NOT NULL
);


ALTER TABLE projet.sae_achete OWNER TO "loelia.coutellier";

--
-- Name: sae_formule; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_formule (
    nom_formule character varying(12) NOT NULL,
    hebergement boolean NOT NULL,
    restauration boolean NOT NULL,
    pret_materiel boolean NOT NULL,
    remontees_meca boolean NOT NULL
);


ALTER TABLE projet.sae_formule OWNER TO "loelia.coutellier";

--
-- Name: nb_non_skieurs; Type: VIEW; Schema: projet; Owner: loelia.coutellier
--

CREATE VIEW projet.nb_non_skieurs AS
 SELECT count(sae_achete.num_client) AS non_skieurs
   FROM (projet.sae_achete
     JOIN projet.sae_formule ON (((sae_achete.nom_formule)::text = (sae_formule.nom_formule)::text)))
  WHERE (sae_formule.remontees_meca = false)
  GROUP BY sae_achete.nom_formule;


ALTER TABLE projet.nb_non_skieurs OWNER TO "loelia.coutellier";

--
-- Name: nb_skieurs; Type: VIEW; Schema: projet; Owner: loelia.coutellier
--

CREATE VIEW projet.nb_skieurs AS
 SELECT count(sae_achete.num_client) AS skieurs
   FROM (projet.sae_achete
     JOIN projet.sae_formule ON (((sae_achete.nom_formule)::text = (sae_formule.nom_formule)::text)))
  WHERE (sae_formule.remontees_meca = true)
  GROUP BY sae_achete.nom_formule;


ALTER TABLE projet.nb_skieurs OWNER TO "loelia.coutellier";

--
-- Name: sae_chambre; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_chambre (
    num_chambre integer NOT NULL,
    etage_chambre character(1) NOT NULL,
    batiment_chambre character(1) NOT NULL,
    nb_lits_chambre integer NOT NULL,
    superficie_chambre integer NOT NULL,
    balcon_chambre boolean NOT NULL,
    vue_chambre projet.vue_chambre NOT NULL
);


ALTER TABLE projet.sae_chambre OWNER TO "loelia.coutellier";

--
-- Name: sae_client; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_client (
    num_client integer NOT NULL,
    nom_client character varying(50) NOT NULL,
    prenom_client character varying(50) NOT NULL,
    date_naissance_client date NOT NULL,
    adresse_client character varying(70) NOT NULL,
    tel_client character(10) DEFAULT NULL::bpchar,
    niveau_client projet.niveau_client,
    taille_client integer,
    poids_client bigint,
    pointure_client bigint,
    nom_groupe character varying(50)
);


ALTER TABLE projet.sae_client OWNER TO "loelia.coutellier";

--
-- Name: sae_correspondance; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_correspondance (
    num_client integer NOT NULL,
    titre character varying(20),
    mdp character(32)
);


ALTER TABLE projet.sae_correspondance OWNER TO "loelia.coutellier";

--
-- Name: sae_groupe; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_groupe (
    nom_groupe character varying(50) NOT NULL
);


ALTER TABLE projet.sae_groupe OWNER TO "loelia.coutellier";

--
-- Name: sae_heberger; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_heberger (
    num_client integer NOT NULL,
    num_chambre integer NOT NULL,
    num_res integer NOT NULL
);


ALTER TABLE projet.sae_heberger OWNER TO "loelia.coutellier";

--
-- Name: sae_preference; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_preference (
    num_client integer NOT NULL,
    num_client2 integer NOT NULL,
    code_niveau_pref projet.code_niveau_pref NOT NULL
);


ALTER TABLE projet.sae_preference OWNER TO "loelia.coutellier";

--
-- Name: sae_reservation; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_reservation (
    num_res integer NOT NULL,
    datedebut_res timestamp without time zone NOT NULL,
    datefin_res timestamp without time zone NOT NULL,
    nom_groupe character varying(50) NOT NULL
);


ALTER TABLE projet.sae_reservation OWNER TO "loelia.coutellier";

--
-- Name: sae_tarif_formule; Type: TABLE; Schema: projet; Owner: loelia.coutellier
--

CREATE TABLE projet.sae_tarif_formule (
    nom_formule character varying(12) NOT NULL,
    annee integer NOT NULL,
    tarif_formule integer NOT NULL
);


ALTER TABLE projet.sae_tarif_formule OWNER TO "loelia.coutellier";

--
-- Data for Name: sae_achete; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_achete (num_client, nom_formule, num_res) FROM stdin;
1	tout compris	1
2	tout compris	1
3	tout compris	1
4	tout compris	1
60	non skieur	1
86	tout compris	1
5	tout compris	2
6	tout compris	2
7	tout compris	2
8	tout compris	2
9	tout compris	2
10	tout compris	2
11	tout compris	2
12	non skieur	2
13	tout compris	2
14	tout compris	2
66	non skieur	2
67	tout compris	2
68	tout compris	2
69	tout compris	2
70	tout compris	2
71	tout compris	2
87	non skieur	2
88	tout compris	2
89	tout compris	2
90	tout compris	2
15	non skieur	3
16	non skieur	3
72	tout compris	3
20	non skieur	4
91	tout compris	4
92	tout compris	4
93	tout compris	4
94	tout compris	4
95	tout compris	4
96	tout compris	4
97	tout compris	4
98	tout compris	4
58	tout compris	5
59	tout compris	5
99	tout compris	5
100	tout compris	5
17	tout compris	6
73	tout compris	6
74	tout compris	6
75	tout compris	6
76	tout compris	6
27	tout compris	7
28	non skieur	8
48	tout compris	9
49	tout compris	9
61	non skieur	9
62	non skieur	9
28	non skieur	10
\.


--
-- Data for Name: sae_chambre; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_chambre (num_chambre, etage_chambre, batiment_chambre, nb_lits_chambre, superficie_chambre, balcon_chambre, vue_chambre) FROM stdin;
1	0	A	4	35	f	parking
2	0	A	2	25	f	pistes
3	0	A	6	50	f	parking
4	0	A	4	35	f	pistes
5	0	A	4	35	f	parking
6	0	A	6	50	f	parking
7	0	A	2	25	f	pistes
8	1	A	2	25	t	parking
9	1	A	6	50	t	parking
10	1	A	4	35	f	pistes
11	1	A	2	25	f	pistes
12	1	A	4	35	t	parking
13	1	A	4	35	t	parking
14	1	A	6	50	f	pistes
15	2	A	2	25	f	parking
16	2	A	2	25	f	parking
17	2	A	6	50	t	pistes
18	2	A	6	50	t	pistes
19	2	A	4	35	f	parking
20	2	A	2	25	t	parking
21	3	A	4	35	t	pistes
22	3	A	4	35	t	parking
23	4	A	4	35	t	pistes
24	4	A	4	35	t	pistes
\.


--
-- Data for Name: sae_client; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_client (num_client, nom_client, prenom_client, date_naissance_client, adresse_client, tel_client, niveau_client, taille_client, poids_client, pointure_client, nom_groupe) FROM stdin;
1	DUPONT	Pierre	1988-08-08	125 Av. du Stade, 45770 Saran	0678912345	confirmé	180	90	43	DUPONT
2	DUPONT	Ambre	1988-09-25	125 Av. du Stade, 45770 Saran	0678912346	moyen	140	62	42	DUPONT
3	DUPONT	Ambroise	1960-01-01	126 Av. du Stade, 45770 Saran	0678912347	confirmé	173	107	48	DUPONT
4	DUPONT	Antoine	1960-01-02	126 Av. du Stade, 45770 Saran	0678912348	confirmé	150	59	35	DUPONT
5	PINEAU	Amélie	1985-03-23	1 rue de Paris, 75001 Paris	0654893277	confirmé	152	77	39	LAIBOGOSS
6	POIRIER	Anastasie	1986-07-20	2 rue de Paris, 75001 Paris	0654893256	débutant	165	59	35	LAIBOGOSS
7	ROBERT	Anatole	1986-03-23	3 rue de Paris, 75001 Paris	0654893290	débutant	185	50	36	LAIBOGOSS
8	RAIMBAULT	Andrée	1985-04-23	4 rue de Paris, 75001 Paris	0654893289	débutant	171	89	42	LAIBOGOSS
9	DELAUNAY	Angèle	2002-12-02	5 rue de Paris, 75001 Paris	0654893283	confirmé	197	57	37	LAIBOGOSS
10	RICHARD	Angeline	1990-03-25	6 rue de Paris, 75001 Paris	0654893282	confirmé	212	49	42	LAIBOGOSS
11	DURAND	Angelique	1999-05-21	7 rue de Paris, 75001 Paris	0648932801	confirmé	175	92	41	LAIBOGOSS
12	CHEVALIER	Annette	1970-06-06	8 rue de Paris, 75001 Paris	0654893280	\N	\N	\N	\N	LAIBOGOSS
13	CHEVALIER	Anselme	1983-02-14	8 rue de Paris, 75001 Paris	0654893279	moyen	155	82	36	LAIBOGOSS
14	CHEVALIER	Annette	1993-05-27	10 rue de Paris, 75001 Paris	0654893278	moyen	156	93	37	LAIBOGOSS
15	BELLANGER	Antoinette	1983-02-14	20 Av. de la Soubriarde, 77185 Lognes	0786452319	\N	\N	\N	\N	BELLANGER
16	BELLANGER	Apollinaire	1993-05-27	20 Av. de la Soubriarde, 77185 Lognes	0786452317	\N	\N	\N	\N	BELLANGER
17	ONILLON	Apolline	1980-02-26	16 rue Nationale, 75001 Paris	0611123456	moyen	213	74	41	ONILLON
20	DAVID	Aristide	1995-05-27	3 bd. Bryas, 59170 Croix	0714235689	\N	\N	\N	\N	77ENFORCE
27	CHUPIN	Célestin	2000-03-27	29 rue Gabriel, 77185 Lognes	0651234897	débutant	143	74	45	CHUPIN
28	THOMAS	Célestine	2001-03-27	30 rue Gabriel, 77185 Lognes	0651234898	\N	\N	\N	\N	THOMAS
48	BOURGEAIS	Edgard	1970-06-06	20 rue Sébastopol, 20 rue Sébastopol, 17100 Saintes	\N	confirmé	173	57	45	BOURGEAIS
49	BOURGEAIS	Édith	1983-02-14	20 rue Sébastopol, 20 rue Sébastopol, 17100 Saintes	\N	confirmé	187	49	46	BOURGEAIS
58	CHIRON	Héloïse	1970-06-06	21 Rue de Strasbourg, 63100 Clermont-ferrand	0213456897	moyen	179	103	46	CHIRON
59	CHIRON	Henri	1983-02-14	21 Rue de Strasbourg, 63100 Clermont-ferrand	0213456897	moyen	171	61	39	CHIRON
60	DUPONT	Henriette	2022-01-01	125 Av. du Stade, 45770 Saran	\N	\N	\N	\N	\N	DUPONT
61	BOURGEAIS	Hercule	2022-02-01	20 rue Sébastopol, 20 rue Sébastopol, 17100 Saintes	\N	\N	\N	\N	\N	BOURGEAIS
62	BOURGEAIS	Hervé	2022-03-01	20 rue Sébastopol, 20 rue Sébastopol, 17100 Saintes	\N	\N	\N	\N	\N	BOURGEAIS
66	COURANT	Hortense	2011-03-23	11 rue de Paris, 75001 Paris	\N	\N	\N	\N	\N	LAIBOGOSS
67	GRIMAULT	Valéry	2012-12-12	12 rue de Paris, 75001 Paris	\N	débutant	116	13	29	LAIBOGOSS
68	BESSON	Véronique	2013-03-23	13 rue de Paris, 75001 Paris	\N	débutant	104	25	36	LAIBOGOSS
69	CHENE	Vespasien	2011-05-06	14 rue de Paris, 75001 Paris	\N	confirmé	133	32	33	LAIBOGOSS
70	LEFORT	Victoire	2015-07-08	15 rue de Paris, 75001 Paris	\N	moyen	117	15	30	LAIBOGOSS
71	PERRAULT	Victorine	2017-08-13	16 rue de Paris, 75001 Paris	\N	débutant	142	44	34	LAIBOGOSS
72	BELLANGER	Vienne	2014-06-07	20 Av. de la Soubriarde, 77185 Lognes	\N	débutant	101	26	31	BELLANGER
73	ONILLON	Violette	2015-01-01	16 rue Nationale, 75001 Paris	\N	débutant	145	46	27	ONILLON
74	ONILLON	Virginie	2016-01-01	16 rue Nationale, 75001 Paris	\N	débutant	123	43	29	ONILLON
75	ONILLON	Vivien	2017-01-01	16 rue Nationale, 75001 Paris	\N	débutant	110	43	26	ONILLON
76	ONILLON	Vivienne	2018-01-01	16 rue Nationale, 75001 Paris	\N	débutant	101	45	35	ONILLON
86	DUPONT	Sophie	2007-12-25	125 Av. du Stade, 45770 Saran	0678912349	moyen	160	78	37	DUPONT
87	BUREAU	Claude	2005-10-03	17 rue de Paris, 75001 Paris	0654893763	\N	\N	\N	\N	LAIBOGOSS
88	BUREAU	Danielle	2006-07-07	17 rue de Paris, 75001 Paris	0654893763	débutant	151	82	36	LAIBOGOSS
89	BUREAU	Denise	2008-09-11	17 rue de Paris, 75001 Paris	0654893763	confirmé	148	69	38	LAIBOGOSS
90	OUVRARD	Claude	2006-05-08	18 rue de Paris, 75001 Paris	0654893764	moyen	160	75	35	LAIBOGOSS
91	ALBERT	Dianne	2005-01-01	3 bd. Bryas, 59170 Croix	0796853412	moyen	150	51	37	77ENFORCE
92	ROCHARD	Dion	2006-03-04	4 bd. Bryas, 59170 Croix	0796853413	moyen	176	88	42	77ENFORCE
93	GASNIER	Evette	2007-05-26	5 bd. Bryas, 59170 Croix	0796853414	moyen	186	67	36	77ENFORCE
94	LEBRUN	Francine	2006-02-15	6 bd. Bryas, 59170 Croix	0796853415	moyen	152	59	36	77ENFORCE
95	GASTINEAU	Gabrielle	2005-03-13	7 bd. Bryas, 59170 Croix	0796853416	moyen	161	72	40	77ENFORCE
96	AUBRY	Giselle	2006-08-12	8 bd. Bryas, 59170 Croix	0796853417	confirmé	146	67	43	77ENFORCE
97	GAULTIER	Gisselle	2006-11-25	9 bd. Bryas, 59170 Croix	0796853418	confirmé	166	78	37	77ENFORCE
98	LEBRETON	Jacqueline	2008-09-27	10 bd. Bryas, 59170 Croix	0796853419	moyen	141	65	37	77ENFORCE
99	CHIRON	Jeanine	2007-05-26	21 Rue de Strasbourg, 63100 Clermont-ferrand	0213456897	moyen	148	57	40	CHIRON
100	CHIRON	Jeannine	2007-05-26	21 Rue de Strasbourg, 63100 Clermont-ferrand	0213456897	moyen	162	81	40	CHIRON
101	CHOCHOIS	Philippe	1985-04-23	2 Rue Albert Einstein, 77420 Champs-sur-Marne	\N	\N	\N	\N	\N	\N
102	POLO	Marco	2000-01-01	12 place Maurice-Charretier, 77420 Champs-sur-marne	0659487312	moyen	190	78	45	\N
\.


--
-- Data for Name: sae_correspondance; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_correspondance (num_client, titre, mdp) FROM stdin;
101	gerant	e419af7469dc53b64fd63cdc9d86a61f
1	chef	c4ca4238a0b923820dcc509a6f75849b
2	client	c81e728d9d4c2f636f067f89cc14862c
3	client	eccbc87e4b5ce2fe28308fd9f2a7baf3
4	client	a87ff679a2f3e71d9181a67b7542122c
5	chef	e4da3b7fbbce2345d7772b0674a318d5
6	client	1679091c5a880faf6fb5e6087eb1b2dc
7	client	8f14e45fceea167a5a36dedd4bea2543
8	client	c9f0f895fb98ab9159f51fd0297e236d
9	client	45c48cce2e2d7fbdea1afc51c7c6ad26
10	client	d3d9446802a44259755d38e6d163e820
11	client	6512bd43d9caa6e02c990b0a82652dca
12	client	c20ad4d76fe97759aa27a0c99bff6710
13	client	c51ce410c124a10e0db5e4b97fc2af39
14	client	aab3238922bcc25a6f606eb525ffdc56
15	client	9bf31c7ff062936a96d3c8bd1f8f2ff3
16	chef	c74d97b01eae257e44aa9d5bade97baf
17	chef	70efdf2ec9b086079795c442636b55fb
20	chef	98f13708210194c475687be6106a3b84
27	chef	02e74f10e0327ad868d138f2b4fdd6f0
28	chef	33e75ff09dd601bbe69f351039152189
48	chef	642e92efb79421734881b53e1e1b18b6
49	client	f457c545a9ded88f18ecee47145a72c0
58	client	66f041e16a60928b05a7e228a89c3799
59	chef	093f65e080a295f8076b1c5722a46aa2
60	client	072b030ba126b2f4b2374f342be9ed44
61	client	7f39f8317fbdb1988ef4c628eba02591
62	client	44f683a84163b3523afe57c2e008bc8c
66	client	3295c76acbf4caaed33c36b1b5fc2cb1
67	client	735b90b4568125ed6c3f678819b6e058
68	client	a3f390d88e4c41f2747bfa2f1b5f87db
69	client	14bfa6bb14875e45bba028a21ed38046
70	client	7cbbc409ec990f19c78c75bd1e06f215
71	client	e2c420d928d4bf8ce0ff2ec19b371514
72	client	32bb90e8976aab5298d5da10fe66f21d
73	client	d2ddea18f00665ce8623e36bd4e3c7c5
74	client	ad61ab143223efbc24c7d2583be69251
75	client	d09bf41544a3365a46c9077ebb5e35c3
76	client	fbd7939d674997cdb4692d34de8633c4
86	client	93db85ed909c13838ff95ccfa94cebd9
87	client	c7e1249ffc03eb9ded908c236bd1996d
88	client	2a38a4a9316c49e5a833517c45d31070
89	client	7647966b7343c29048673252e490f736
90	client	8613985ec49eb8f757ae6439e879bb2a
91	client	54229abfcfa5649e7003b83dd4755294
92	client	92cc227532d17e56e07902b254dfad10
93	client	98dce83da57b0395e163467c9dae521b
94	client	f4b9ec30ad9f68f89b29639786cb62ef
95	client	812b4ba287f5ee0bc9d43bbf5bbe87fb
96	client	26657d5ff9020d2abefe558796b99584
97	client	e2ef524fbf3d9fe611d5a8e90fefdc9c
98	client	ed3d2c21991e3bef5e069713af9fa6ca
99	client	ac627ab1ccbdb62ec96e702f07f6425b
100	client	f899139df5e1059396431415e770c6dd
102	client	5653c6b1f51852a6351ec69c8452abc6
\.


--
-- Data for Name: sae_formule; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_formule (nom_formule, hebergement, restauration, pret_materiel, remontees_meca) FROM stdin;
non skieur	t	t	f	f
tout compris	t	t	t	t
\.


--
-- Data for Name: sae_groupe; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_groupe (nom_groupe) FROM stdin;
77ENFORCE
BELLANGER
BOURGEAIS
CHIRON
CHUPIN
DUPONT
LAIBOGOSS
ONILLON
THOMAS
\.


--
-- Data for Name: sae_heberger; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_heberger (num_client, num_chambre, num_res) FROM stdin;
27	2	7
28	2	8
99	2	5
100	2	5
1	3	1
2	3	1
3	3	1
4	3	1
60	3	1
86	3	1
15	4	3
16	4	3
48	4	9
49	4	9
61	4	9
62	4	9
72	4	3
17	6	6
73	6	6
74	6	6
75	6	6
76	6	6
20	11	4
91	12	4
92	12	4
93	12	4
94	12	4
95	13	4
96	13	4
97	13	4
98	13	4
12	15	2
13	15	2
14	16	2
87	16	2
11	17	2
69	17	2
70	17	2
88	17	2
89	17	2
90	17	2
7	18	2
8	18	2
9	18	2
10	18	2
67	18	2
71	18	2
5	19	2
6	19	2
66	19	2
68	19	2
58	20	5
59	20	5
28	1	10
\.


--
-- Data for Name: sae_preference; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_preference (num_client, num_client2, code_niveau_pref) FROM stdin;
1	2	1
1	60	1
1	86	1
3	1	2
3	4	1
12	13	1
15	16	1
15	72	1
17	73	1
17	74	1
17	75	1
17	76	1
48	49	2
48	61	1
48	62	1
59	58	1
66	90	3
87	14	2
87	89	4
88	89	2
88	90	2
96	97	2
98	20	4
99	59	4
99	100	1
\.


--
-- Data for Name: sae_reservation; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_reservation (num_res, datedebut_res, datefin_res, nom_groupe) FROM stdin;
1	2022-12-18 11:00:00	2022-12-24 10:00:00	DUPONT
2	2023-01-01 11:00:00	2023-01-07 10:00:00	LAIBOGOSS
3	2023-01-08 11:00:00	2023-01-14 10:00:00	BELLANGER
4	2022-12-18 11:00:00	2022-12-24 10:00:00	77ENFORCE
5	2023-01-01 11:00:00	2023-01-07 10:00:00	CHIRON
6	2023-02-05 11:00:00	2023-02-11 10:00:00	ONILLON
7	2023-01-08 11:00:00	2023-01-14 10:00:00	CHUPIN
8	2022-12-18 11:00:00	2022-12-24 10:00:00	THOMAS
9	2022-12-18 11:00:00	2022-12-24 10:00:00	BOURGEAIS
10	2023-01-14 11:00:00	2023-01-21 10:00:00	THOMAS
\.


--
-- Data for Name: sae_tarif_formule; Type: TABLE DATA; Schema: projet; Owner: loelia.coutellier
--

COPY projet.sae_tarif_formule (nom_formule, annee, tarif_formule) FROM stdin;
non skieur	2020	420
non skieur	2021	450
non skieur	2022	465
non skieur	2023	490
tout compris	2020	510
tout compris	2021	540
tout compris	2022	555
tout compris	2023	580
\.


--
-- Name: sae_achete sae_achete_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_achete
    ADD CONSTRAINT sae_achete_pkey PRIMARY KEY (num_client, nom_formule, num_res);


--
-- Name: sae_chambre sae_chambre_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_chambre
    ADD CONSTRAINT sae_chambre_pkey PRIMARY KEY (num_chambre);


--
-- Name: sae_client sae_client_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_client
    ADD CONSTRAINT sae_client_pkey PRIMARY KEY (num_client);


--
-- Name: sae_correspondance sae_correspondance_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_correspondance
    ADD CONSTRAINT sae_correspondance_pkey PRIMARY KEY (num_client);


--
-- Name: sae_formule sae_formule_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_formule
    ADD CONSTRAINT sae_formule_pkey PRIMARY KEY (nom_formule);


--
-- Name: sae_groupe sae_groupe_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_groupe
    ADD CONSTRAINT sae_groupe_pkey PRIMARY KEY (nom_groupe);


--
-- Name: sae_heberger sae_heberger_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_heberger
    ADD CONSTRAINT sae_heberger_pkey PRIMARY KEY (num_client, num_chambre, num_res);


--
-- Name: sae_preference sae_preference_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_preference
    ADD CONSTRAINT sae_preference_pkey PRIMARY KEY (num_client, num_client2);


--
-- Name: sae_reservation sae_reservation_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_reservation
    ADD CONSTRAINT sae_reservation_pkey PRIMARY KEY (num_res);


--
-- Name: sae_tarif_formule sae_tarif_formule_pkey; Type: CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_tarif_formule
    ADD CONSTRAINT sae_tarif_formule_pkey PRIMARY KEY (nom_formule, annee);


--
-- Name: sae_heberger fk_cham_heber; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_heberger
    ADD CONSTRAINT fk_cham_heber FOREIGN KEY (num_chambre) REFERENCES projet.sae_chambre(num_chambre) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_preference fk_cli2_pref; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_preference
    ADD CONSTRAINT fk_cli2_pref FOREIGN KEY (num_client2) REFERENCES projet.sae_client(num_client) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_achete fk_cli_achete; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_achete
    ADD CONSTRAINT fk_cli_achete FOREIGN KEY (num_client) REFERENCES projet.sae_client(num_client) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_heberger fk_cli_heber; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_heberger
    ADD CONSTRAINT fk_cli_heber FOREIGN KEY (num_client) REFERENCES projet.sae_client(num_client) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_preference fk_cli_pref; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_preference
    ADD CONSTRAINT fk_cli_pref FOREIGN KEY (num_client) REFERENCES projet.sae_client(num_client) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_achete fk_form_achete; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_achete
    ADD CONSTRAINT fk_form_achete FOREIGN KEY (nom_formule) REFERENCES projet.sae_formule(nom_formule) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_tarif_formule fk_form_tarif; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_tarif_formule
    ADD CONSTRAINT fk_form_tarif FOREIGN KEY (nom_formule) REFERENCES projet.sae_formule(nom_formule) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_client fk_grp_cli; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_client
    ADD CONSTRAINT fk_grp_cli FOREIGN KEY (nom_groupe) REFERENCES projet.sae_groupe(nom_groupe) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_reservation fk_grp_reser; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_reservation
    ADD CONSTRAINT fk_grp_reser FOREIGN KEY (nom_groupe) REFERENCES projet.sae_groupe(nom_groupe) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_correspondance fk_num_cli; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_correspondance
    ADD CONSTRAINT fk_num_cli FOREIGN KEY (num_client) REFERENCES projet.sae_client(num_client) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_achete fk_res_achete; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_achete
    ADD CONSTRAINT fk_res_achete FOREIGN KEY (num_res) REFERENCES projet.sae_reservation(num_res) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sae_heberger fk_res_heber; Type: FK CONSTRAINT; Schema: projet; Owner: loelia.coutellier
--

ALTER TABLE ONLY projet.sae_heberger
    ADD CONSTRAINT fk_res_heber FOREIGN KEY (num_res) REFERENCES projet.sae_reservation(num_res) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SCHEMA projet; Type: ACL; Schema: -; Owner: loelia.coutellier
--

REVOKE ALL ON SCHEMA projet FROM PUBLIC;
REVOKE ALL ON SCHEMA projet FROM "loelia.coutellier";
GRANT ALL ON SCHEMA projet TO "loelia.coutellier";
GRANT USAGE ON SCHEMA projet TO "dieu-tien.houangkeo";


--
-- Name: TABLE sae_achete; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_achete FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_achete FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_achete TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_achete TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_formule; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_formule FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_formule FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_formule TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_formule TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_chambre; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_chambre FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_chambre FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_chambre TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_chambre TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_client; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_client FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_client FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_client TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_client TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_correspondance; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_correspondance FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_correspondance FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_correspondance TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_correspondance TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_groupe; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_groupe FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_groupe FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_groupe TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_groupe TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_heberger; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_heberger FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_heberger FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_heberger TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_heberger TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_preference; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_preference FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_preference FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_preference TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_preference TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_reservation; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_reservation FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_reservation FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_reservation TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_reservation TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- Name: TABLE sae_tarif_formule; Type: ACL; Schema: projet; Owner: loelia.coutellier
--

REVOKE ALL ON TABLE projet.sae_tarif_formule FROM PUBLIC;
REVOKE ALL ON TABLE projet.sae_tarif_formule FROM "loelia.coutellier";
GRANT ALL ON TABLE projet.sae_tarif_formule TO "loelia.coutellier";
GRANT SELECT ON TABLE projet.sae_tarif_formule TO "dieu-tien.houangkeo" WITH GRANT OPTION;


--
-- PostgreSQL database dump complete
--

