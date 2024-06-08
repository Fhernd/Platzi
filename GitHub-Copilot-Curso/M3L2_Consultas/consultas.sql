-- ¿Cuáles son las propiedades que han vendido al menos dos veces?

SELECT 
    p.id AS propiedad_id,
    p.descripcion AS propiedad_descripcion,
    COUNT(d.id) AS numero_de_ventas
FROM 
    Propiedad p
JOIN 
    Documento d ON p.id = d.propiedad_id
GROUP BY 
    p.id, p.descripcion
HAVING 
    COUNT(d.id) >= 2;
