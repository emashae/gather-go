import React from 'react';
import { Box, Typography } from '@mui/material';
import { styles } from './styles';

const Card = ({ title, children }) => (
  <Box sx={styles.card}>
    <Typography variant="h6" gutterBottom>
      {title}
    </Typography>
    {children}
  </Box>
);

export default Card;
