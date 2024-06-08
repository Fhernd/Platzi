-- ¿Cuáles son las propiedades que se han vendido al menos dos veces?

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


-- ¿Entre vehículo e inmueble cuál de los dos es el que menos se ha visto presente en un documento de venta?
SELECT 
    tipo_propiedad.descripcion AS tipo,
    COUNT(documento.id) AS cantidad_documentos
FROM 
    Documento documento
JOIN 
    Propiedad propiedad ON documento.propiedad_id = propiedad.id
JOIN 
    TipoPropiedad tipo_propiedad ON propiedad.tipo_propiedad_id = tipo_propiedad.id
WHERE 
    tipo_propiedad.descripcion IN ('Vehículo', 'Inmueble')
GROUP BY 
    tipo_propiedad.descripcion
ORDER BY 
    cantidad_documentos ASC
LIMIT 1;
