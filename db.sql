--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.8
-- Dumped by pg_dump version 9.5.12

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: postgres; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE postgres WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE postgres OWNER TO postgres;

\connect postgres

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: DATABASE postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: grupo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo (
    id integer NOT NULL,
    nombre text,
    codigo text
);


ALTER TABLE public.grupo OWNER TO postgres;

--
-- Name: grupo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_id_seq OWNER TO postgres;

--
-- Name: grupo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_id_seq OWNED BY public.grupo.id;


--
-- Name: grupo_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_usuario (
    id integer NOT NULL,
    grupo_id integer,
    usuario_id integer
);


ALTER TABLE public.grupo_usuario OWNER TO postgres;

--
-- Name: grupo_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.grupo_usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_usuario_id_seq OWNER TO postgres;

--
-- Name: grupo_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.grupo_usuario_id_seq OWNED BY public.grupo_usuario.id;


--
-- Name: proyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proyecto (
    id integer NOT NULL,
    nombre text,
    descripcion text,
    fechacreacion timestamp without time zone,
    path text,
    usuario_id integer
);


ALTER TABLE public.proyecto OWNER TO postgres;

--
-- Name: proyecto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.proyecto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proyecto_id_seq OWNER TO postgres;

--
-- Name: proyecto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.proyecto_id_seq OWNED BY public.proyecto.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id integer NOT NULL,
    nombre text,
    email text,
    password text
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;


--
-- Name: vis_usuario_preset; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vis_usuario_preset (
    id integer NOT NULL,
    preset_name character varying(100),
    node_color_rgb character varying(255),
    node_color_x numeric(10,6),
    node_color_y numeric(10,6),
    node_color_z numeric(10,6),
    node_size numeric(10,6),
    node_shape integer DEFAULT 1,
    node_edge_color_rgb character varying(255),
    node_edge_color_x numeric(10,6),
    node_edge_color_y numeric(10,6),
    node_edge_color_z numeric(10,6),
    node_edge_line_width numeric(10,6),
    usuario_id integer
);


ALTER TABLE public.vis_usuario_preset OWNER TO postgres;

--
-- Name: usuario_presets_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_presets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_presets_id_seq OWNER TO postgres;

--
-- Name: usuario_presets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_presets_id_seq OWNED BY public.vis_usuario_preset.id;


--
-- Name: vis_proyecto_config; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vis_proyecto_config (
    id integer NOT NULL,
    file character varying(255),
    usuario_id integer,
    proyecto_id integer NOT NULL,
    path text
);


ALTER TABLE public.vis_proyecto_config OWNER TO postgres;

--
-- Name: TABLE vis_proyecto_config; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.vis_proyecto_config IS 'Relaciona los proyectos y archivos de usuarios con otra tabla para vincular presets de visualizacion a los mismos';


--
-- Name: vis_proyecto_archivo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vis_proyecto_archivo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vis_proyecto_archivo_id_seq OWNER TO postgres;

--
-- Name: vis_proyecto_archivo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vis_proyecto_archivo_id_seq OWNED BY public.vis_proyecto_config.id;


--
-- Name: vis_proyecto_file_world; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vis_proyecto_file_world (
    id integer NOT NULL,
    count integer,
    range double precision,
    world_width integer,
    world_height integer,
    seed double precision,
    max_iterations integer,
    edge_model character varying(255),
    comm_model character varying(255),
    transm_model character varying(255),
    vis_proyecto_archivo_id integer
);


ALTER TABLE public.vis_proyecto_file_world OWNER TO postgres;

--
-- Name: vis_proyecto_file_world_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vis_proyecto_file_world_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vis_proyecto_file_world_id_seq OWNER TO postgres;

--
-- Name: vis_proyecto_file_world_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vis_proyecto_file_world_id_seq OWNED BY public.vis_proyecto_file_world.id;


--
-- Name: vis_proyecto_preset; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vis_proyecto_preset (
    id integer NOT NULL,
    node_color_rgb character varying(255),
    node_color_x numeric(10,2),
    node_color_y numeric(10,2),
    node_color_z numeric(10,2),
    node_size numeric(10,2),
    node_shape integer DEFAULT 1,
    node_edge_color_rgb character varying(255),
    node_edge_color_x numeric(10,2),
    node_edge_color_y numeric(10,2),
    node_edge_color_z numeric(10,2),
    node_edge_line_width numeric(10,2),
    vis_proyecto_archivo_id integer
);


ALTER TABLE public.vis_proyecto_preset OWNER TO postgres;

--
-- Name: vis_proyecto_preset_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vis_proyecto_preset_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vis_proyecto_preset_id_seq OWNER TO postgres;

--
-- Name: vis_proyecto_preset_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vis_proyecto_preset_id_seq OWNED BY public.vis_proyecto_preset.id;


--
-- Name: vis_proyecto_snapshots; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vis_proyecto_snapshots (
    id integer NOT NULL,
    snapshot_id character varying(255) NOT NULL,
    world_filename character varying(255) NOT NULL,
    proyecto_id integer NOT NULL,
    proyecto_file character varying(255) NOT NULL,
    usuario_id integer NOT NULL
);


ALTER TABLE public.vis_proyecto_snapshots OWNER TO postgres;

--
-- Name: vis_proyecto_snapshots_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vis_proyecto_snapshots_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vis_proyecto_snapshots_id_seq OWNER TO postgres;

--
-- Name: vis_proyecto_snapshots_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vis_proyecto_snapshots_id_seq OWNED BY public.vis_proyecto_snapshots.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo ALTER COLUMN id SET DEFAULT nextval('public.grupo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_usuario ALTER COLUMN id SET DEFAULT nextval('public.grupo_usuario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto ALTER COLUMN id SET DEFAULT nextval('public.proyecto_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_proyecto_config ALTER COLUMN id SET DEFAULT nextval('public.vis_proyecto_archivo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_proyecto_file_world ALTER COLUMN id SET DEFAULT nextval('public.vis_proyecto_file_world_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_proyecto_preset ALTER COLUMN id SET DEFAULT nextval('public.vis_proyecto_preset_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_proyecto_snapshots ALTER COLUMN id SET DEFAULT nextval('public.vis_proyecto_snapshots_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_usuario_preset ALTER COLUMN id SET DEFAULT nextval('public.usuario_presets_id_seq'::regclass);


--
-- Data for Name: grupo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo (id, nombre, codigo) FROM stdin;
1	Desarrollador de Aplicaciones de Simulación	G_DES
\.


--
-- Name: grupo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_id_seq', 1, true);


--
-- Data for Name: grupo_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_usuario (id, grupo_id, usuario_id) FROM stdin;
1	1	1
2	1	2
\.


--
-- Name: grupo_usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.grupo_usuario_id_seq', 2, true);


--
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.proyecto (id, nombre, descripcion, fechacreacion, path, usuario_id) FROM stdin;
2	proy_test1	proyecto de prueba para prop gral	2017-07-28 18:21:39	/var/www/shawnweb/shawn/src/legacyapps/proy_test1	1
3	camino_mcorto1	algoritmo de roteo por el camino mas corto	2017-08-17 18:38:59	/var/www/shawnweb/shawn/src/legacyapps/camino_mcorto1	1
5	proyecto_b1	un proyecto de prueba	2018-05-03 20:58:32	/var/www/shawnweb/shawn/src/legacyapps/proyecto_b1	1
6	proyecto_a1	un proyecto de prueba	2018-05-03 21:20:11	/var/www/shawnweb/shawn/src/legacyapps/proyecto_a1	1
\.


--
-- Name: proyecto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.proyecto_id_seq', 6, true);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (id, nombre, email, password) FROM stdin;
1	test	test@test.com	test
2	usuario2	usuario2@usuario2.com	usuario2
\.


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_seq', 2, true);


--
-- Name: usuario_presets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_presets_id_seq', 16, true);


--
-- Name: vis_proyecto_archivo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vis_proyecto_archivo_id_seq', 16, true);


--
-- Data for Name: vis_proyecto_config; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vis_proyecto_config (id, file, usuario_id, proyecto_id, path) FROM stdin;
11	simpleapp_vis.conf	1	2	/var/www/shawnweb/shawn/src/legacyapps/proy_test1
12	simpleapp.conf	1	2	/var/www/shawnweb/shawn/src/legacyapps/proy_test1
13	simpleapp.conf	1	5	/var/www/shawnweb/shawn/src/legacyapps/proyecto_b1
14	simpleapp_3.conf	1	5	/var/www/shawnweb/shawn/src/legacyapps/proyecto_b1
15	simpleapp.conf	1	6	/var/www/shawnweb/shawn/src/legacyapps/proyecto_a1
16	simpleapp_2.conf	1	6	/var/www/shawnweb/shawn/src/legacyapps/proyecto_a1
\.


--
-- Data for Name: vis_proyecto_file_world; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vis_proyecto_file_world (id, count, range, world_width, world_height, seed, max_iterations, edge_model, comm_model, transm_model, vis_proyecto_archivo_id) FROM stdin;
3	25	1	15	15	1331178	10	simple	disk_graph	null	11
4	35	4	15	15	1246121213	10	fast_list	rim	null	12
5	90	1.5	7	7	1331177	5	simple	disk_graph	null	13
6	25	2.5	10	10	9895659	3	simple	disk_graph	null	14
7	90	2.60000000000000009	20	20	65633654	3	simple	disk_graph	null	15
\.


--
-- Name: vis_proyecto_file_world_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vis_proyecto_file_world_id_seq', 7, true);


--
-- Data for Name: vis_proyecto_preset; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vis_proyecto_preset (id, node_color_rgb, node_color_x, node_color_y, node_color_z, node_size, node_shape, node_edge_color_rgb, node_edge_color_x, node_edge_color_y, node_edge_color_z, node_edge_line_width, vis_proyecto_archivo_id) FROM stdin;
58	rgb(20, 173, 17)	0.08	0.68	0.07	0.25	1	rgb(0, 212, 34)	0.00	0.83	0.13	0.01	11
59	rgb(255, 0, 0)	1.00	0.00	0.00	0.25	2	rgb(0, 0, 204)	0.00	0.00	0.80	0.07	11
69	rgb(224, 55, 55)	0.88	0.22	0.22	0.50	2	rgb(255, 0, 0)	1.00	0.00	0.00	0.10	12
71	rgb(31, 18, 176)	0.12	0.07	0.69	0.45	1	rgb(19, 15, 204)	0.07	0.06	0.80	0.03	13
72	rgb(255, 0, 0)	1.00	0.00	0.00	0.25	2	rgb(0, 0, 204)	0.00	0.00	0.80	0.07	15
73	rgb(20, 173, 17)	0.08	0.68	0.07	0.25	1	rgb(0, 212, 34)	0.00	0.83	0.13	0.01	15
74	rgb(255, 0, 0)	1.00	0.00	0.00	0.25	2	rgb(0, 0, 204)	0.00	0.00	0.80	0.07	16
75	rgb(20, 173, 17)	0.08	0.68	0.07	0.25	1	rgb(0, 212, 34)	0.00	0.83	0.13	0.01	16
\.


--
-- Name: vis_proyecto_preset_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vis_proyecto_preset_id_seq', 75, true);


--
-- Data for Name: vis_proyecto_snapshots; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vis_proyecto_snapshots (id, snapshot_id, world_filename, proyecto_id, proyecto_file, usuario_id) FROM stdin;
14	id:2-1520605916	world-2_1520605916_simpleapp_vis.conf.xml	2	simpleapp_vis.conf	1
15	id:2-1524614312	world-2_1524614312_simpleapp.conf.xml	2	simpleapp.conf	1
16	id:2-1524615667	world-2_1524615667_simpleapp_vis.conf.xml	2	simpleapp_vis.conf	1
17	id:2-1524615720	world-2_1524615720_simpleapp_vis.conf.xml	2	simpleapp_vis.conf	1
18	id:2-1524615807	world-2_1524615807_simpleapp_vis.conf.xml	2	simpleapp_vis.conf	1
19	id:6-1525383029	world-6_1525383029_simpleapp.conf.xml	6	simpleapp.conf	1
\.


--
-- Name: vis_proyecto_snapshots_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vis_proyecto_snapshots_id_seq', 19, true);


--
-- Data for Name: vis_usuario_preset; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vis_usuario_preset (id, preset_name, node_color_rgb, node_color_x, node_color_y, node_color_z, node_size, node_shape, node_edge_color_rgb, node_edge_color_x, node_edge_color_y, node_edge_color_z, node_edge_line_width, usuario_id) FROM stdin;
7	Preset from front	rgb(255, 0, 0)	1.000000	0.000000	0.000000	0.250000	2	'rgb(0, 0, 204)'	0.000000	0.000000	0.800000	0.070000	1
12	Nodos verdes	rgb(20, 173, 17)	0.078574	0.680000	0.066300	0.250000	1	rgb(0, 212, 34)	0.000000	0.830000	0.132800	0.010000	1
16	DispAzul	rgb(31, 18, 176)	0.121854	0.072450	0.690000	0.450000	1	rgb(19, 15, 204)	0.074800	0.060000	0.800000	0.025000	1
\.


--
-- Name: grupo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo
    ADD CONSTRAINT grupo_pkey PRIMARY KEY (id);


--
-- Name: grupo_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_usuario
    ADD CONSTRAINT grupo_usuario_pkey PRIMARY KEY (id);


--
-- Name: proyecto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT proyecto_pkey PRIMARY KEY (id);


--
-- Name: uq_cec2d17135de7b6e7a5ffac8b66a19b88495b3dd; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_usuario
    ADD CONSTRAINT uq_cec2d17135de7b6e7a5ffac8b66a19b88495b3dd UNIQUE (grupo_id, usuario_id);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: usuario_presets_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_usuario_preset
    ADD CONSTRAINT usuario_presets_pkey PRIMARY KEY (id);


--
-- Name: vis_proyecto_file_world_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_proyecto_file_world
    ADD CONSTRAINT vis_proyecto_file_world_pkey PRIMARY KEY (id);


--
-- Name: vis_proyecto_preset_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_proyecto_preset
    ADD CONSTRAINT vis_proyecto_preset_pkey PRIMARY KEY (id);


--
-- Name: vis_proyecto_snapshots_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vis_proyecto_snapshots
    ADD CONSTRAINT vis_proyecto_snapshots_pkey PRIMARY KEY (id);


--
-- Name: index_for_grupo_usuario_grupo_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_for_grupo_usuario_grupo_id ON public.grupo_usuario USING btree (grupo_id);


--
-- Name: index_for_grupo_usuario_usuario_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_for_grupo_usuario_usuario_id ON public.grupo_usuario USING btree (usuario_id);


--
-- Name: index_foreignkey_proyecto_usuario; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX index_foreignkey_proyecto_usuario ON public.proyecto USING btree (usuario_id);


--
-- Name: fk746fd774fb4643b4a83cbe99348fc7e6a; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_usuario
    ADD CONSTRAINT fk746fd774fb4643b4a83cbe99348fc7e6a FOREIGN KEY (grupo_id) REFERENCES public.grupo(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk746fd774fb4643b4a83cbe99348fc7e6b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_usuario
    ADD CONSTRAINT fk746fd774fb4643b4a83cbe99348fc7e6b FOREIGN KEY (usuario_id) REFERENCES public.usuario(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: proyecto_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT proyecto_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuario(id) ON UPDATE SET NULL ON DELETE SET NULL DEFERRABLE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

