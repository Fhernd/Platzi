import React from 'react';

const ProductComponent = ({ product }) => {
  return (
    <div>
      <h2>{product.name}</h2>
      <p>Código: {product.code}</p>
      <p>Descripción: {product.description}</p>
      <p>Cantidad: {product.quantity}</p>
      <p>Precio: {product.price}</p>
    </div>
  );
};

export default ProductComponent;
