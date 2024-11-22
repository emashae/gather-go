import React from 'react';
import { Box, List, ListItem, ListItemText, Typography } from '@mui/material';
import { styles } from './styles';

const Navigation = ({ role = 'attendee', onNavigate }) => {
  const navItems = {
    admin: ['Overview', 'Manage Events', 'Users', 'Reports'],
    organizer: ['Overview', 'My Events', 'Analytics'],
    attendee: ['Overview', 'My Tickets', 'Settings'],
  };

  const items = navItems[role] || [];

  return (
    <Box sx={styles.container}>
      <Typography variant="h6" sx={styles.header}>
        Event Manager
      </Typography>
      <List>
        {items.map((item) => (
          <ListItem
            button
            key={item}
            sx={styles.listItem}
            onClick={() => onNavigate(item)}
          >
            <ListItemText primary={item} />
          </ListItem>
        ))}
      </List>
    </Box>
  );
};

export default Navigation;
