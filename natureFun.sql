--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

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
-- Name: child_c_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.child_c_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.child_c_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: child; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.child (
    child_name text NOT NULL,
    medical_number integer NOT NULL,
    allergy_info text,
    notes text,
    age integer NOT NULL,
    f_id integer NOT NULL,
    birthdate date NOT NULL,
    c_id integer DEFAULT nextval('public.child_c_id_seq'::regclass) NOT NULL
);


ALTER TABLE public.child OWNER TO postgres;

--
-- Name: family_f_ic_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.family_f_ic_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.family_f_ic_seq OWNER TO postgres;

--
-- Name: family; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.family (
    family_name text NOT NULL,
    parent_name text NOT NULL,
    phone character(13) NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    "security_Q" text NOT NULL,
    "security_A" text NOT NULL,
    f_id integer DEFAULT nextval('public.family_f_ic_seq'::regclass) NOT NULL,
    emergency_contact text NOT NULL,
    emergency_phone character(13) NOT NULL,
    doctor text NOT NULL,
    doctor_phone character(13) NOT NULL,
    child_pickup text NOT NULL,
    can_call_emerg boolean NOT NULL,
    can_take_photos boolean NOT NULL,
    date timestamp without time zone NOT NULL,
    sign text NOT NULL
);


ALTER TABLE public.family OWNER TO postgres;

--
-- Name: reg_r_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reg_r_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.reg_r_id_seq OWNER TO postgres;

--
-- Name: registration; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.registration (
    r_id integer DEFAULT nextval('public.reg_r_id_seq'::regclass) NOT NULL,
    s_id integer NOT NULL,
    c_id integer NOT NULL,
    "isPaid" boolean NOT NULL
);


ALTER TABLE public.registration OWNER TO postgres;

--
-- Name: session_s_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.session_s_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.session_s_id_seq OWNER TO postgres;

--
-- Name: session; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.session (
    time_and_date timestamp(4) without time zone NOT NULL,
    max_attendance integer,
    title text NOT NULL,
    "isFull" boolean NOT NULL,
    s_id integer DEFAULT nextval('public.session_s_id_seq'::regclass) NOT NULL
);


ALTER TABLE public.session OWNER TO postgres;

--
-- Name: wait_w_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.wait_w_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.wait_w_id_seq OWNER TO postgres;

--
-- Name: waitlist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.waitlist (
    w_id integer DEFAULT nextval('public.wait_w_id_seq'::regclass) NOT NULL,
    c_id integer NOT NULL,
    s_id integer NOT NULL
);


ALTER TABLE public.waitlist OWNER TO postgres;

--
-- Data for Name: child; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.child (child_name, medical_number, allergy_info, notes, age, f_id, birthdate, c_id) FROM stdin;
Hank	123456789	\N	\N	5	1	2014-01-01	1
\.


--
-- Data for Name: family; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.family (family_name, parent_name, phone, email, password, "security_Q", "security_A", f_id, emergency_contact, emergency_phone, doctor, doctor_phone, child_pickup, can_call_emerg, can_take_photos, date, sign) FROM stdin;
\.


--
-- Data for Name: registration; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.registration (r_id, s_id, c_id, "isPaid") FROM stdin;
\.


--
-- Data for Name: session; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.session (time_and_date, max_attendance, title, "isFull", s_id) FROM stdin;
\.


--
-- Data for Name: waitlist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.waitlist (w_id, c_id, s_id) FROM stdin;
\.


--
-- Name: child_c_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.child_c_id_seq', 1, false);


--
-- Name: family_f_ic_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.family_f_ic_seq', 1, false);


--
-- Name: reg_r_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reg_r_id_seq', 1, false);


--
-- Name: session_s_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.session_s_id_seq', 1, false);


--
-- Name: wait_w_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.wait_w_id_seq', 1, false);


--
-- Name: child child_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child
    ADD CONSTRAINT child_pkey PRIMARY KEY (c_id);


--
-- Name: family f_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.family
    ADD CONSTRAINT f_id_pkey PRIMARY KEY (f_id);


--
-- Name: child medical_number; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.child
    ADD CONSTRAINT medical_number UNIQUE (medical_number) INCLUDE (medical_number);


--
-- Name: family parent_name; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.family
    ADD CONSTRAINT parent_name UNIQUE (parent_name) INCLUDE (parent_name);


--
-- Name: registration registration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT registration_pkey PRIMARY KEY (r_id);


--
-- Name: session session_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_pkey PRIMARY KEY (s_id);


--
-- Name: waitlist waitlist_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.waitlist
    ADD CONSTRAINT waitlist_pkey PRIMARY KEY (w_id);


--
-- Name: registration cid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT cid_fkey FOREIGN KEY (c_id) REFERENCES public.child(c_id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: waitlist cid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.waitlist
    ADD CONSTRAINT cid_fkey FOREIGN KEY (c_id) REFERENCES public.child(c_id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: registration sid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registration
    ADD CONSTRAINT sid_fkey FOREIGN KEY (s_id) REFERENCES public.session(s_id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: waitlist sid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.waitlist
    ADD CONSTRAINT sid_fkey FOREIGN KEY (s_id) REFERENCES public.session(s_id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

