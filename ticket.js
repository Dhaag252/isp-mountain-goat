document.addEventListener('DOMContentLoaded', () => {
    const ticketList = document.querySelector('.ticket-list');
  
    // Simuleer nieuwe tickets ophalen
    const tickets = [
      { subject: 'Probleem met inloggen', description: 'Ik krijg een foutmelding bij het inloggen.', status: 'Open' },
      { subject: 'Vragen over facturatie', description: 'Kan ik mijn factuur opnieuw ontvangen?', status: 'In behandeling' }
    ];
  
    tickets.forEach(ticket => {
      const ticketDiv = document.createElement('div');
      ticketDiv.classList.add('ticket');
      ticketDiv.innerHTML = `
        <h3>Onderwerp: ${ticket.subject}</h3>
        <p>Beschrijving: ${ticket.description}</p>
        <span>Status: ${ticket.status}</span>
      `;
      ticketList.appendChild(ticketDiv);
    });
  });
  