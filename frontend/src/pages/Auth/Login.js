import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { login } from '../../redux/authSlice';
import { useNavigate } from 'react-router-dom';
import { Box, Button, TextField, Typography, CircularProgress, Paper } from '@mui/material';
import { styles } from './styles';

function Login() {
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [errorMessage, setErrorMessage] = useState('');

  const { user, isLoading, error } = useSelector((state) => state.auth);

  // Redirect if user is logged in
  useEffect(() => {
    if (user) {
      navigate('/dashboard'); // Redirect to Dashboard
    }
  }, [user, navigate]);

  const handleLogin = (e) => {
    e.preventDefault();
    if (!email.includes('@')) {
      setErrorMessage('Invalid email format');
      return;
    }
    if (password.length < 6) {
      setErrorMessage('Password must be at least 6 characters');
      return;
    }
    setErrorMessage('');
    dispatch(login({ email, password }));
  };

  return (
    <Box sx={styles.container}>
      <Paper elevation={3} sx={styles.card}>
        <Typography variant="h4" sx={styles.title}>
          Login
        </Typography>
        <form onSubmit={handleLogin}>
          <TextField
            fullWidth
            label="Email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            sx={styles.input}
          />
          <TextField
            fullWidth
            label="Password"
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
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
            {isLoading ? <CircularProgress size={24} color="inherit" /> : 'Login'}
          </Button>
        </form>
        {errorMessage && (
          <Typography variant="body2" sx={styles.errorMessage}>
            {errorMessage}
          </Typography>
        )}
        {error && (
          <Typography variant="body2" sx={styles.errorMessage}>
            {error.message}
          </Typography>
        )}
        <Typography
          variant="body2"
          sx={{ color: '#9f89d9', marginTop: '16px', cursor: 'pointer' }}
          onClick={() => navigate('/register')}
        >
          Don't have an account? <strong>Register</strong>
        </Typography>
      </Paper>
    </Box>
  );
}

export default Login;
