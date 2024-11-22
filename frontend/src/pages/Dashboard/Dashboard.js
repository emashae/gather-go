import React from 'react';
import { Box, Typography, Grid } from '@mui/material';
import styles from './styles';

const Dashboard = () => (
  <Box sx={styles.root}>
    <Typography variant="h4" gutterBottom>
      Welcome back, Lucy!
    </Typography>
    <Grid container spacing={3}>
      <Grid item xs={12} sm={6} md={4}>
        <Box sx={styles.card}>
          <Typography variant="h6">Visitors</Typography>
          <Typography variant="h4">24,532</Typography>
        </Box>
      </Grid>
      <Grid item xs={12} sm={6} md={4}>
        <Box sx={styles.card}>
          <Typography variant="h6">Activity</Typography>
          <Typography variant="h4">63,200</Typography>
        </Box>
      </Grid>
      <Grid item xs={12} sm={6} md={4}>
        <Box sx={styles.card}>
          <Typography variant="h6">Bounce</Typography>
          <Typography variant="h4">12,364</Typography>
        </Box>
      </Grid>
    </Grid>
  </Box>
);

export default Dashboard;
