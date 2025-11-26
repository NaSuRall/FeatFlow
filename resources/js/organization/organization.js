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
        memberTitle.innerText = "Voir les membres de " + orgName;
        addMemberForm.action = `/organizations/${orgId}/members`; 
        memberModal.classList.remove('hidden');
    });
});

closeMemberBtn.addEventListener('click', () => {
    memberModal.classList.add('hidden');
});


// Modal modifier organization
const editOrgModal = document.getElementById('editOrgModal');
const editOrgTitle = document.getElementById('editOrgModalTitle');
const editOrgNameField = document.getElementById('editOrgNameField');
const editOrgForm = document.getElementById('editOrgForm');
const closeEditOrgModal = document.getElementById('closeEditOrgModal');

document.querySelectorAll('.editOrgBtn').forEach(btn => {
    btn.addEventListener('click', () => {

        const orgName = btn.dataset.name;
        const orgId = btn.dataset.id;

        editOrgTitle.innerText = "Modifier le nom";
        editOrgNameField.value = orgName;

        editOrgForm.action = `/organizations/${orgId}`;

        editOrgModal.classList.remove('hidden');
    });
});

closeEditOrgModal.addEventListener('click', () => {
    editOrgModal.classList.add('hidden');
});


