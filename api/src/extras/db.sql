DROP TABLE IF EXISTS public.working_hours, public.user;

CREATE TABLE public.user (
    id SERIAL PRIMARY KEY, 
    name VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    start_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
    end_date TIMESTAMP,
    is_admin BOOLEAN NOT NULL DEFAULT false
);

CREATE TABLE public.working_hours (
    id SERIAL PRIMARY KEY,
    user_id INTEGER,
    work_date TIMESTAMP NOT NULL,
    time1 TIME,
    time2 TIME,
    time3 TIME,
    time4 TIME,
    worked_time INT,

    FOREIGN KEY (user_id) REFERENCES public.user(id) ON DELETE CASCADE,
    CONSTRAINT cons_user_day UNIQUE (user_id, work_date)
);

-- Essas senhas criptografadas correspondem ao valor "a"
INSERT INTO public.user (id, name, password, email, start_date, is_admin)
VALUES (1, 'Admin', '$2y$10$D9fm0eoPepp/YXOohOuGP.vr0bM.xCWHUa1XQzTCSDoLNIDVs2Unm', 'admin@jonloureiro.dev', '2000-01-01 00:00:00', true);

INSERT INTO public.user (id, name, password, email, start_date, is_admin)
VALUES (2, 'Jonathan', '$2y$10$4BnsxsztwM235SGkd59YVuP.I2clfxm93.imZ6PYxAS1XIMfQEyyu', 'me@jonloureiro.dev', '2000-01-01 00:00:00', true);

INSERT INTO public.user (id, name, password, email, start_date, end_date)
VALUES (3, 'Duarte', '$2y$10$emWC43sQ2AsPWaomnsbC1e1LjVsikZ8CaXYc5kNvdyfuzpEHirYlq', 'duarte@jonloureiro.dev', '2000-01-01 00:00:00', '2020-01-01 00:00:00');

INSERT INTO public.user (id, name, password, email)
VALUES (4, 'Paulo', '$2y$10$ZtWYZJEL9.CaP773Zzw4ueNVzJc6DBQg7tBEC0s1XcPd8Ulza9Zum', 'paulo@jonloureiro.dev');

INSERT INTO public.user (id, name, password, email)
VALUES (5, 'Adão', '$2y$10$beWYl7SanyQ3KKS8KNPb3eB1a7vFSbOM.eA2el3LHJiJj5Jxbtjw.', 'adao@jonloureiro.dev');

SELECT * FROM public.user;