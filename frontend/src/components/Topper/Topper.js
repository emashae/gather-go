import React from 'react';
import { Box, Typography, TextField } from '@mui/material';
import styles from './styles';

const Topper = () => (
  <Box sx={styles.root}>
    <Typography variant="h6">Analytics Dashboard</Typography>
    <TextField
      variant="outlined"
      placeholder="Search topics..."
      sx={styles.searchBar}
    />
    <Box sx={styles.profileSection}>
      {/* Add notification icons, profile picture, etc. */}
      <Typography>User Profile</Typography>
    </Box>
  </Box>
);

export default Topper;
