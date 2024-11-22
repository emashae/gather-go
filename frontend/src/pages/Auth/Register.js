import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import { Box, Button, TextField, Typography, Paper } from '@mui/material';
import { register } from '../../redux/authSlice';
import { styles } from './styles';

function Register() {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const { isLoading, error } = useSelector((state) => state.auth);

  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleRegister = async (e) => {
    e.preventDefault();

    if (formData.password !== formData.confirmPassword) {
      alert("Passwords don't match");
      return;
    }

    try {
      const result = await dispatch(register({
        name: formData.name,
        email: formData.email,
        password: formData.password,
        password_confirmation: formData.confirmPassword,
      })).unwrap(); 

      alert('Registration successful!');
      navigate('/login');
    } catch (err) {
      console.error('Registration failed:', err);
    }
  };

  return (
    <Box sx={styles.container}>
      <Paper elevation={3} sx={styles.card}>
        <Typography variant="h4" sx={styles.title}>
          Register
        </Typography>
        <form onSubmit={handleRegister}>
          <TextField
            fullWidth
            label="Name"
            name="name"
            value={formData.name}
            onChange={handleInputChange}
            required
            sx={styles.input}
          />
          <TextField
            fullWidth
            label="Email"
            name="email"
            type="email"
            value={formData.email}
            onChange={handleInputChange}
            required
            sx={styles.input}
          />
          <TextField
            fullWidth
            label="Password"
            name="password"
            type="password"
            value={formData.password}
            onChange={handleInputChange}
            required
            sx={styles.input}
          />
          <TextField
            fullWidth
            label="Confirm Password"
            name="confirmPassword"
            type="password"
            value={formData.confirmPassword}
            onChange={handleInputChange}
            required
            sx={styles.input}
          />
          <Button
            type="submit"
            fullWidth
            variant="contained"
            sx={styles.button}
            disabled={isLoading}
          >
            {isLoading ? 'Registering...' : 'Register'}
          </Button>
        </form>
        {error && (
          <Typography color="error" variant="body2" sx={{ marginTop: '16px' }}>
            {error.message || 'Registration failed.'}
          </Typography>
        )}
        <Typography
          variant="body2"
          sx={{ color: '#9f89d9', marginTop: '16px', cursor: 'pointer' }}
          onClick={() => navigate('/login')}
        >
          Already have an account? <strong>Login</strong>
        </Typography>
      </Paper>
    </Box>
  );
}

export default Register;
