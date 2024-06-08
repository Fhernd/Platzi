import math

class Calculator:
    def add(self, a, b):
        return a + b

    def subtract(self, a, b):
        return a - b

    def multiply(self, a, b):
        return a * b

    def divide(self, a, b):
        if b == 0:
            raise ValueError("Cannot divide by zero")
        return a / b

    def square_root(self, a):
        if a < 0:
            raise ValueError("Cannot calculate square root of a negative number")
        return math.sqrt(a)

    def power(self, a, b):
        return a ** b

    def modulo(self, a, b):
        if b == 0:
            raise ValueError("Cannot calculate modulo zero")
        return a % b
