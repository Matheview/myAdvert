/*	TYPES		*/
CREATE TYPE login_result AS (tab_name varchar, tab_hash varchar, tab_city varchar, tab_phone integer);



/*	   FUNCTIONS	 */
/*   domain adress   */

CREATE FUNCTION domain_name() RETURNS varchar AS $$
BEGIN
	RETURN 'myAdvert.pl';
END;
$$ LANGUAGE plpgsql;
	

/*register user*/
CREATE FUNCTION register_user(varchar, varchar, varchar, varchar, integer) RETURNS varchar AS $$
declare
    error text;
BEGIN
    IF EXISTS(SELECT * FROM users WHERE user_email=$2) THEN
		RETURN 'User alread exists';
	END IF;
	INSERT INTO users VALUES (NULL, $1, $2, hash_passwd($3), $4, $5, NOW());
	RETURN CONCAT('Welcome ', $1, ' on service ', domain_name());
							  
	EXCEPTION
    WHEN OTHERS THEN
        GET STACKED DIAGNOSTICS error = PG_EXCEPTION_CONTEXT;
        RAISE INFO 'Błąd 1: %', SQLERRM;
        RAISE INFO 'Błąd 2: %', SQLSTATE;
        RAISE INFO 'Błąd 3: %', err_context;
        return 'Wystąpił błąd';
END;
$$ LANGUAGE plpgsql;


/*hash password*/
CREATE OR REPLACE FUNCTION hash_passwd(character varying) RETURNS character varying AS $$
BEGIN
	RETURN md5(concat(md5($1), md5($1)));
END;
$$ LANGUAGE plpgsql;


/*login user*/
CREATE OR REPLACE FUNCTION login_user(varchar, varchar) RETURNS login_result AS $$
DECLARE
	lr login_result;
	var_passwd varchar;
BEGIN
	var_passwd = hash_passwd($2);
	SELECT user_id, user_name, user_passwd, user_city, user_phone 
		INTO lr.tab_hash, lr.tab_name, var_passwd, lr.tab_city, lr.tab_phone 
		FROM users 
		WHERE user_email=$1 AND deleted_at IS NULL AND user_passwd=var_passwd;
	RETURN lr;
END;
$$ LANGUAGE plpgsql;

/*		tworzenie oferty automotive				desc_short, desc_long, stan, marka, model, cena, user_id, mileage, engine, rok*/
CREATE OR REPLACE FUNCTION offer_automotive.create_offer_automotive(varchar, text, varchar, varchar, varchar, float8, bigint, integer, float8, integer) RETURNS bigint AS $$
DECLARE
	var_category bigint;
	var_brand bigint;
	var_model bigint;
	var_engine integer;
	var_offer_id bigint;
BEGIN
	SELECT brand_id 
		INTO var_brand 
		FROM offer_automotive.brand
		WHERE brand_desc=INITCAP($4);
	IF var_brand IS NULL THEN
		INSERT INTO offer_automotive.brand(brand_desc, created_at) 
			VALUES (INITCAP($4), NOW()) 
			RETURNING brand_id INTO var_brand;
	END IF;
	SELECT model_id 
		INTO var_model
		FROM offer_automotive.model 
		WHERE model_desc=INITCAP($5);
	IF var_model IS NULL THEN
		INSERT INTO offer_automotive.model(model_desc, created_at) 
			VALUES (INITCAP($5), NOW()) 
			RETURNING model_id INTO var_model;
	END IF;
	IF $9 < 50 THEN
	    var_engine = $9*1000;
	ELSE
	    var_engine = $9;
	END IF;
	INSERT INTO offer_automotive.offers(offer_desc, desc_long, brand_id, model_id, condition_id, price, user_id, engine, mileage, year, created_at) 
			VALUES ($1, $2, var_brand, var_model, $3::integer, $6, $7, var_engine::integer, $8, $10, NOW()) 
			RETURNING offer_id INTO var_offer_id;
	RETURN var_offer_id;
	EXCEPTION
    WHEN OTHERS THEN RETURN 0;
END;
$$ LANGUAGE plpgsql;


/*		tworzenie oferty clothes			desc_short, desc_long, stan, marka, kolor, cena, user_id, rozmiar, płeć(może być przecież kilka - w dzisiejszych czasach)*/
CREATE OR REPLACE FUNCTION offer_clothes.create_offer_clothes(varchar, text, varchar, varchar, varchar, float8, bigint, varchar, varchar) RETURNS bigint AS $$
DECLARE
	var_brand bigint;
	var_color bigint;
	var_size bigint;
	var_offer_id bigint;
	var_sex bigint;
BEGIN
	SELECT brand_id 
		INTO var_brand 
		FROM offer_clothes.brand
		WHERE brand_desc=INITCAP($4);
	IF var_brand IS NULL THEN
		INSERT INTO offer_clothes.brand(brand_desc, created_at) 
			VALUES (INITCAP($4), NOW()) 
			RETURNING brand_id INTO var_brand;
	END IF;
	SELECT color_id 
		INTO var_color
		FROM offer_clothes.color
		WHERE color_desc=INITCAP($5);
	IF var_color IS NULL THEN
		INSERT INTO offer_clothes.color(color_desc, created_at) 
			VALUES (INITCAP($5), NOW()) 
			RETURNING color_id INTO var_color;
	END IF;
	SELECT sex_id 
		INTO var_sex
		FROM offer_clothes.sex_key
		WHERE sex_desc=INITCAP($9);
	IF var_sex IS NULL THEN
		INSERT INTO offer_clothes.sex_key(color_desc, created_at) 
			VALUES (INITCAP($9), NOW()) 
			RETURNING sex_id INTO var_sex;
	END IF;
	SELECT size_id 
		INTO var_size
		FROM offer_clothes.size
		WHERE size_desc=INITCAP($8);
	IF var_size IS NULL THEN
		INSERT INTO offer_clothes.size(size_desc, created_at) 
			VALUES (INITCAP($8), NOW()) 
			RETURNING size_id INTO var_size;
	END IF;
	INSERT INTO offer_clothes.offers(offer_desc, desc_long, brand_id, color_id, condition_id, price, user_id, size_id, created_at) 
			VALUES ($1, $2, var_brand, var_color, $3::integer, $6, $7, var_size, NOW()) 
			RETURNING offer_id INTO var_offer_id;
	RETURN var_offer_id;
END;
$$ LANGUAGE plpgsql;

/*		tworzenie oferty electronics			desc_short, desc_long, stan, marka, model, cena, user_id*/
CREATE OR REPLACE FUNCTION offer_electronics.create_offer_automotive(varchar, text, varchar, varchar, varchar, float8, bigint) RETURNS bigint AS $$
DECLARE
	var_brand bigint;
	var_model bigint;
	var_offer_id bigint;
BEGIN
	SELECT brand_id 
		INTO var_brand 
		FROM offer_electronics.brand
		WHERE brand_desc=INITCAP($4);
	IF var_brand IS NULL THEN
		INSERT INTO offer_electronics.brand(brand_desc, created_at) 
			VALUES (INITCAP($4), NOW()) 
			RETURNING brand_id INTO var_brand;
	END IF;
	SELECT model_id 
		INTO var_model
		FROM offer_electronics.model 
		WHERE model_desc=INITCAP($5);
	IF var_model IS NULL THEN
		INSERT INTO offer_electronics.model(model_desc, created_at) 
			VALUES (INITCAP($5), NOW()) 
			RETURNING model_id INTO var_model;
	END IF;
	INSERT INTO offer_electronics.offers(offer_desc, desc_long, brand_id, model_id, condition_id, price, user_id, created_at) 
			VALUES ($1, $2, var_brand, var_model, $3::integer, $6, $7, NOW()) 
			RETURNING offer_id INTO var_offer_id;
	RETURN var_offer_id;
	EXCEPTION
    WHEN OTHERS THEN RETURN 0;
END;
$$ LANGUAGE plpgsql;

/*		tworzenie oferty akcesoria muzyczne			  desc_short, desc_long, stan, marka, model, cena, user_id, typ akcesorii*/
CREATE OR REPLACE FUNCTION offer_music_accessories.create_offer_music_acc(varchar, text, varchar, varchar, varchar, float8, bigint, varchar) RETURNS bigint AS $$
DECLARE
	var_brand bigint;
	var_model bigint;
	var_type bigint;
	var_offer_id bigint;
BEGIN
	SELECT brand_id 
		INTO var_brand 
		FROM offer_music_accessories.brand
		WHERE brand_desc=INITCAP($4);
	IF var_brand IS NULL THEN
		INSERT INTO offer_music_accessories.brand(brand_desc, created_at) 
			VALUES (INITCAP($4), NOW()) 
			RETURNING brand_id INTO var_brand;
	END IF;
	SELECT model_id 
		INTO var_model
		FROM offer_music_accessories.model 
		WHERE model_desc=INITCAP($5);
	IF var_model IS NULL THEN
		INSERT INTO offer_music_accessories.model(model_desc, created_at) 
			VALUES (INITCAP($5), NOW()) 
			RETURNING model_id INTO var_model;
	END IF;
	SELECT type_id 
		INTO var_type
		FROM offer_music_accessories.type 
		WHERE type_desc=INITCAP($8);
	IF var_type IS NULL THEN
		INSERT INTO offer_music_accessories.type(type_desc, created_at) 
			VALUES (INITCAP($8), NOW()) 
			RETURNING type_id INTO var_type;
	END IF;
	INSERT INTO offer_music_accessories.offers(desc_short, desc_long, brand_id, model_id, condition_id, price, user_id, type_id, created_at) 
			VALUES ($1, $2, var_brand, var_model, $3::integer, $6, $7, var_type, NOW()) 
			RETURNING offer_id INTO var_offer_id;
	RETURN var_offer_id;
END;
$$ LANGUAGE plpgsql;


/*	delete_offer						offer_id, user_id*/
CREATE OR REPLACE FUNCTION delete_offer(integer, integer) RETURNS boolean AS $$
BEGIN
	IF EXISTS(SELECT * FROM offers WHERE offer_id=$1 AND user_id=$2) THEN
		DELETE FROM offers WHERE offer_id=$1;
		RETURN true;
	END IF;
	RETURN false;
END;
$$ LANGUAGE plpgsql;


/*	update_offer						    offer_id, user_id, desc_short, desc_long, main, secondary*/
CREATE OR REPLACE FUNCTION update_offer_desc(integer, integer, varchar, text, varchar, varchar) RETURNS boolean AS $$
DECLARE
	var_main bigint;
	var_second bigint;
BEGIN
	IF NOT EXISTS(SELECT * FROM offers WHERE offer_id=$1 AND user_id=$2) THEN
		RETURN false;
	END IF;
	IF $3='not_set' AND $4='not_set' AND $5='not_set' AND $6='not_set' THEN
		RETURN false;
	END IF;
	IF $3!='not_set' THEN
		UPDATE offers SET offer_desc=$3 WHERE offer_id=$1;
	END IF;
	IF $4!='not_set' THEN
		UPDATE offers SET desc_long=$4 WHERE offer_id=$1;
	END IF;
	IF $5!='not_set' THEN
		SELECT main_key_id INTO var_main FROM main_key WHERE main_key_desc=INITCAP($5);
		IF var_main IS NULL THEN
			INSERT INTO main_key(category_id, main_key_desc, created_at) 
				VALUES (var_category, INITCAP($4), NOW()) 
				RETURNING main_key_id INTO var_main;
		END IF;
		UPDATE offers SET main_key_id=var_main WHERE offer_id=$1;
	END IF;
	IF $6!='not_set' THEN
		SELECT secondary_key_id INTO var_second FROM secondary_key WHERE secondary_key_desc=INITCAP($6);
		IF var_second IS NULL THEN
		INSERT INTO secondary_key(main_key_id, secondary_key_desc, created_at) 
			VALUES (var_main, INITCAP($6), NOW()) 
			RETURNING secondary_key_id INTO var_second;
		END IF;
		UPDATE offers SET secondary_key_id=var_second WHERE offer_id=$1;
		RETURN true;
	END IF;
	RETURN true;
END;
$$ LANGUAGE plpgsql;





/*	add_picture						    offer_id, picture_name*/
CREATE OR REPLACE FUNCTION add_picture(integer, varchar) RETURNS boolean AS $$
BEGIN
	IF $1<1 THEN
		RETURN false;
	END IF;
	INSERT INTO pictures(offer_id, picture_name, created_at) VALUES ($1, $2, NOW());
	RETURN true;
END;
$$ LANGUAGE plpgsql;


/*	get_pictures					    offer_id */
CREATE OR REPLACE FUNCTION offer_automotive.get_pictures(integer) RETURNS TABLE(path_file varchar) AS $$
DECLARE
	var_category varchar;
BEGIN
	SELECT category_desc INTO var_category FROM category WHERE id=2;
	RETURN QUERY (SELECT concat('/imgs/', var_category, '/', $1, '/', picture_name) FROM offer_automotive.pictures WHERE offer_id=$1);
END;
$$ LANGUAGE plpgsql;


/*   show short info */
WITH i AS(SELECT concat('offers_picture/automotive/', offer_id, '/', picture_name) file, 
			     ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
		  FROM offer_automotive.pictures p)
SELECT i.file, desc_short, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...'), u.user_city, price, oa.created_at
	FROM offer_automotive.offers oa 
	INNER JOIN users u ON oa.user_id=u.user_id, i
	WHERE i.queue=1 AND i.offer_id=oa.offer_id
	ORDER BY oa.offer_id DESC;
	
/* zmienna, służyła za zmienną pomocniczą - ale wyleciała */
CREATE TYPE automotive_search_result AS (tab_id bigint, tab_image varchar, tab_desc_short varchar, tab_desc_long varchar, tab_city varchar, tab_price float8, tab_created_at timestamp without time zone);


/* pokaż listę ofert w całości automotive + parametr wyszukiwania - domyślnie '' */
CREATE OR REPLACE FUNCTION offer_automotive.show_offers(varchar) RETURNS TABLE (tab_id bigint, tab_image varchar, tab_desc_short varchar, tab_desc_long varchar, tab_city varchar, tab_price float8, tab_created_at timestamp without time zone) AS $$
DECLARE
	tab_result automotive_search_result;
BEGIN
	IF $1 != '' THEN
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/automotive/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_automotive.pictures p)
		SELECT oa.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, u.user_city::varchar, price::float8, oa.created_at::timestamp without time zone
			FROM offer_automotive.offers oa 
			INNER JOIN users u ON oa.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oa.offer_id AND (oa.desc_short @@ to_tsquery($1) or desc_long @@ to_tsquery($1))
			ORDER BY oa.offer_id DESC;
	ELSE
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/automotive/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_automotive.pictures p)
		SELECT oa.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, 
		u.user_city::varchar, price::float8, oa.created_at::timestamp without time zone
			FROM offer_automotive.offers oa 
			INNER JOIN users u ON oa.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oa.offer_id
			ORDER BY oa.offer_id DESC;
	END IF;
END;
$$ LANGUAGE plpgsql



/* pokaż listę ofert w całości clothes + parametr wyszukiwania - domyślnie '' */
CREATE OR REPLACE FUNCTION offer_clothes.show_offers(varchar) RETURNS TABLE (tab_id bigint, tab_image varchar, tab_desc_short varchar, tab_desc_long varchar, tab_city varchar, tab_price float8, tab_created_at timestamp without time zone) AS $$
BEGIN
	IF $1 != '' THEN
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/clothes/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_clothes.pictures p)
		SELECT oc.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, u.user_city::varchar, price::float8, oc.created_at::timestamp without time zone
			FROM offer_clothes.offers oc
			INNER JOIN users u ON oc.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oc.offer_id AND (oc.desc_short @@ to_tsquery($1) or desc_long @@ to_tsquery($1))
			ORDER BY oc.offer_id DESC;
	ELSE
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/clothes/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_clothes.pictures p)
		SELECT oc.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, 
		u.user_city::varchar, price::float8, oc.created_at::timestamp without time zone
			FROM offer_clothes.offers oc 
			INNER JOIN users u ON oc.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oc.offer_id
			ORDER BY oc.offer_id DESC;
	END IF;
END;
$$ LANGUAGE plpgsql;



/* pokaż listę ofert w całości electronics + parametr wyszukiwania - domyślnie '' */
CREATE OR REPLACE FUNCTION offer_electronics.show_offers(varchar) RETURNS TABLE (tab_id bigint, tab_image varchar, tab_desc_short varchar, tab_desc_long varchar, tab_city varchar, tab_price float8, tab_created_at timestamp without time zone) AS $$
BEGIN
	IF $1 != '' THEN
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/electronics/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_electronics.pictures p)
		SELECT oe.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, u.user_city::varchar, price::float8, oe.created_at::timestamp without time zone
			FROM offer_clothes.offers oe
			INNER JOIN users u ON oe.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oe.offer_id AND (oe.desc_short @@ to_tsquery($1) or desc_long @@ to_tsquery($1))
			ORDER BY oe.offer_id DESC;
	ELSE
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/electronics/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_electronics.pictures p)
		SELECT oe.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, 
		u.user_city::varchar, price::float8, oe.created_at::timestamp without time zone
			FROM offer_electronics.offers oe 
			INNER JOIN users u ON oe.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oe.offer_id
			ORDER BY oe.offer_id DESC;
	END IF;
END;
$$ LANGUAGE plpgsql;



/* pokaż listę ofert w całości music accessories + parametr wyszukiwania - domyślnie '' */
CREATE OR REPLACE FUNCTION offer_music_accessories.show_offers(varchar) RETURNS TABLE (tab_id bigint, tab_image varchar, tab_desc_short varchar, tab_desc_long varchar, tab_city varchar, tab_price float8, tab_created_at timestamp without time zone) AS $$
BEGIN
	IF $1 != '' THEN
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/music-accessories/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_music_accessories.pictures p)
		SELECT oma.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, u.user_city::varchar, price::float8, oma.created_at::timestamp without time zone
			FROM offer_music_accessories.offers oma
			INNER JOIN users u ON oma.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oma.offer_id AND (oma.desc_short @@ to_tsquery($1) or desc_long @@ to_tsquery($1))
			ORDER BY oma.offer_id DESC;
	ELSE
		RETURN QUERY WITH i AS(SELECT concat('offers_picture/music-accessories/', offer_id, '/', picture_name) file, 
					 ROW_NUMBER() OVER(PARTITION BY p.offer_id ORDER BY p.picture_id ASC) as queue, p.offer_id
			  FROM offer_music_accessories.pictures p)
		SELECT oma.offer_id::bigint, i.file::varchar, desc_short::varchar, concat(regexp_replace(SUBSTRING(desc_long, 1, 250), '\r|\n', ' ', 'g'), '...')::varchar, 
		u.user_city::varchar, price::float8, oma.created_at::timestamp without time zone
			FROM offer_music_accessories.offers oma 
			INNER JOIN users u ON oma.user_id=u.user_id, i
			WHERE i.queue=1 AND i.offer_id=oma.offer_id
			ORDER BY oma.offer_id DESC;
	END IF;
END;
$$ LANGUAGE plpgsql;


/*    wyświetlanie pojedyńczych ofert */
/* automotive */
CREATE OR REPLACE FUNCTION offer_automotive.show_offer_info(bigint) RETURNS TABLE (desc_short varchar, 
																	   desc_long text, 
																	   brand varchar,
																	   model varchar,
																	   mileage integer,
																	   price numeric,
																	   year integer,
																	   contition varchar,
																	   engine varchar,
																	   created_at timestamp without time zone,
																	   user_name varchar,
																	   city varchar,
																	   phone_num varchar) AS $$
BEGIN
	RETURN QUERY (SELECT oa.desc_short, oa.desc_long, b.brand_desc as brand, m.model_desc as model, oa.mileage, oa.price, oa.year, c.condition_desc as condition, concat(oa.engine, ' cm3')::varchar as engine, oa.created_at, u.user_name, u.user_city, u.user_phone
				  		FROM offer_automotive.offers oa
				  		INNER JOIN offer_automotive.brand b ON oa.brand_id=b.brand_id
				  		INNER JOIN offer_automotive.model m ON oa.model_id=m.model_id
				  		INNER JOIN condition c ON oa.condition_id=c.condition_id
						INNER JOIN users u ON oa.user_id=u.user_id
				  		WHERE oa.offer_id=$1);
END; 
$$ LANGUAGE plpgsql;

/* clothes */
CREATE OR REPLACE FUNCTION offer_clothes.show_offer_info(bigint) RETURNS TABLE (desc_short varchar, 
																	   desc_long text, 
																	   brand varchar,
																	   price numeric,
																	   contition varchar,
																	   size varchar,
																	   sex varchar,
																	   color varchar,
																	   created_at timestamp without time zone,
																	   user_name varchar,
																	   city varchar,
																	   phone_num varchar) AS $$
BEGIN
	RETURN QUERY (SELECT oc.desc_short, oc.desc_long, b.brand_desc as brand, oc.price, c.condition_desc as condition, si.size_desc as size, sex.sex_desc as sex, col.color_desc as color, oc.created_at, u.user_name, u.user_city, u.user_phone
				  		FROM offer_clothes.offers oc
				  		INNER JOIN offer_clothes.brand b ON oc.brand_id=b.brand_id
				  		INNER JOIN offer_clothes.size si ON oc.size_id=si.size_id
						INNER JOIN offer_clothes.sex_key sex ON oc.sex_id=sex.sex_id
						INNER JOIN offer_clothes.color col ON oc.color_id=col.color_id
				  		INNER JOIN condition c ON oc.condition_id=c.condition_id
						INNER JOIN users u ON oc.user_id=u.user_id
				  		WHERE oc.offer_id=$1);
END; 
$$ LANGUAGE plpgsql;

/* electronics */
CREATE OR REPLACE FUNCTION offer_electronics.show_offer_info(bigint) RETURNS TABLE (desc_short varchar, 
																	   desc_long text, 
																	   brand varchar,
																	   model varchar,
																	   price numeric,
																	   contition varchar,
																	   created_at timestamp without time zone,
																	   user_name varchar,
																	   city varchar,
																	   phone_num varchar) AS $$
BEGIN
	RETURN QUERY (SELECT oe.desc_short, oe.desc_long, b.brand_desc as brand, m.model_desc as model, oe.price, c.condition_desc as condition, oe.created_at, u.user_name, u.user_city, u.user_phone
				  		FROM offer_electronics.offers oe
				  		INNER JOIN offer_electronics.brand b ON oe.brand_id=b.brand_id
						INNER JOIN offer_electronics.model m ON oe.model_id=m.model_id
				  		INNER JOIN condition c ON oe.condition_id=c.condition_id
						INNER JOIN users u ON oe.user_id=u.user_id
				  		WHERE oe.offer_id=$1);
END; 
$$ LANGUAGE plpgsql;

/* music_accessories */
CREATE OR REPLACE FUNCTION offer_music_accessories.show_offer_info(bigint) RETURNS TABLE (desc_short varchar, 
																	   desc_long text,
																	   type varchar,
																	   brand varchar,
																	   model varchar,
																	   price numeric,
																	   contition varchar,
																	   created_at timestamp without time zone,
																	   user_name varchar,
																	   city varchar,
																	   phone_num varchar) AS $$
BEGIN
	RETURN QUERY (SELECT oma.desc_short, oma.desc_long, t.type_desc as type, b.brand_desc as brand, m.model_desc as model, oma.price, c.condition_desc as condition, oma.created_at, u.user_name, u.user_city, u.user_phone
				  		FROM offer_music_accessories.offers oma
						INNER JOIN offer_music_accessories.type t ON oma.type_id=t.type_id
				  		INNER JOIN offer_music_accessories.brand b ON oma.brand_id=b.brand_id
						INNER JOIN offer_music_accessories.model m ON oma.model_id=m.model_id
				  		INNER JOIN condition c ON oma.condition_id=c.condition_id
						INNER JOIN users u ON oma.user_id=u.user_id
				  		WHERE oma.offer_id=$1);
END; 
$$ LANGUAGE plpgsql;

/* pobieranie zdjęć foreach */
CREATE OR REPLACE FUNCTION offer_automotive.get_images(bigint) RETURNS TABLE (image varchar) AS $$
BEGIN
	RETURN QUERY (SELECT concat('offers_picture/automotive/', $1, '/', picture_name)::varchar as image FROM offer_automotive.pictures WHERE offer_id=$1);
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION offer_clothes.get_images(bigint) RETURNS TABLE (image varchar) AS $$
BEGIN
	RETURN QUERY (SELECT concat('offers_picture/clothes/', $1, '/', picture_name)::varchar as image FROM offer_clothes.pictures WHERE offer_id=$1);
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION offer_electronics.get_images(bigint) RETURNS TABLE (image varchar) AS $$
BEGIN
	RETURN QUERY (SELECT concat('offers_picture/electronics/', $1, '/', picture_name)::varchar as image FROM offer_electronics.pictures WHERE offer_id=$1);
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION offer_music_accessories.get_images(bigint) RETURNS TABLE (image varchar) AS $$
BEGIN
	RETURN QUERY (SELECT concat('offers_picture/music-accessories/', $1, '/', picture_name)::varchar as image FROM offer_music_accessories.pictures WHERE offer_id=$1);
END;
$$ LANGUAGE plpgsql;