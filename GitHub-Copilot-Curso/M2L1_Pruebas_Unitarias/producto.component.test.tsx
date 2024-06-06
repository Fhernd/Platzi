import React from 'react';
import { render, screen } from '@testing-library/react';
import ProductComponent from './ProductComponent';

test('renders product details correctly', () => {
  const mockProduct = {
    code: '123',
    name: 'Test Product',
    description: 'This is a test product',
    quantity: 10,
    price: 100.00
  };

  render(<ProductComponent product={mockProduct} />);

  expect(screen.getByText('Test Product')).toBeInTheDocument();
  expect(screen.getByText('Código: 123')).toBeInTheDocument();
  expect(screen.getByText('Descripción: This is a test product')).toBeInTheDocument();
  expect(screen.getByText('Cantidad: 10')).toBeInTheDocument();
  expect(screen.getByText('Precio: 100')).toBeInTheDocument();
});
