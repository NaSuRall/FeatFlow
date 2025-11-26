// Modal organization
const modal = document.getElementById('orgModal');
const modalTitle = document.getElementById('orgModalTitle');
const modalContent = document.getElementById('orgModalContent');
const closeBtn = document.getElementById('closeOrgModal');

console.log('Dashboard JS loaded');
document.querySelectorAll('.openOrgBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        const name = btn.dataset.name;
        modalTitle.innerText = name;
        modalContent.innerText = "Mettre les sondages ici";
        modal.classList.remove('hidden');
    });
});

closeBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
});

// Modal membre
const memberModal = document.getElementById('memberModal');
const memberTitle = document.getElementById('memberModalTitle');
const closeMemberBtn = document.getElementById('closeMemberModal');
const addMemberForm = document.getElementById('addMemberForm');

document.querySelectorAll('.addMemberBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        const orgName = btn.dataset.name;
        const orgId = btn.dataset.id;
        memberTitle.innerText = "Ajouter un membre à " + orgName;
        addMemberForm.action = `/organizations/${orgId}/members`; 
        memberModal.classList.remove('hidden');
    });
});

closeMemberBtn.addEventListener('click', () => {
    memberModal.classList.add('hidden');
});
