CREATE TABLE chords (
    chord character varying(16),
    song character varying(16),
    format character varying(16),
    body text,
    notes text
);

CREATE TABLE links (
    song character varying(16) NOT NULL,
    title character varying(256) NOT NULL,
    url character varying(512) NOT NULL
);

CREATE TABLE pp (
    pp character varying(16) NOT NULL,
    song character varying(16) NOT NULL,
    mtime date  NOT NULL
);
CREATE TABLE android_metadata (locale TEXT);
CREATE TABLE lists (
       list varchar(16) not null,
       date date not null,
       title varchar,
       author varchar
);

CREATE TABLE list_items(
       list varchar(16) not null,
       song varchar(16) not null,
       sort int
);

--CREATE TABLE song_lyrics (song,lyrics);

CREATE TABLE songs (
    song character varying(16) NOT NULL,
    title character varying(256),
    artist character varying(256),
    alias character varying(256),
    album character varying(256),
    key character varying(16),
    rhythm character varying(32),
    year_added numeric(4,0),
    kind varchar(64),
    CONSTRAINT songs_chk CHECK ((year_added > (1990)))
);
