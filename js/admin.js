document.addEventListener('DOMContentLoaded', () => {
    // Crear usuario
    const userForm = document.getElementById('createUserForm');
    userForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(userForm);
        formData.append('create_user', true);

        try {
            const response = await fetch('../php/admin.php', {
                method: 'POST',
                body: formData,
            });

            // Verifica si la respuesta fue exitosa
            if (!response.ok) {
                console.error('Error en la solicitud:', response.status, response.statusText);
                alert('Hubo un error con la solicitud al servidor.');
                return;
            }

            // Intenta analizar la respuesta JSON
            const result = await response.json();

            if (result.success) {
                alert(result.message);

                const tbody = document.getElementById('userTableBody');
                tbody.innerHTML += `
                    <tr id="user-${result.user.id}">
                        <td>${result.user.id}</td>
                        <td>${result.user.username}</td>
                        <td>${result.user.role}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-user" data-id="${result.user.id}">Eliminar</button>
                        </td>
                    </tr>
                `;
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error('Error al procesar la solicitud:', error);
            alert('Hubo un problema al procesar la solicitud. Intenta nuevamente.');
        }
    });

    // Eliminar usuario
    document.getElementById('userTableBody').addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-user')) {
            const userId = e.target.dataset.id;

            const formData = new FormData();
            formData.append('delete_user', userId);

            try {
                const response = await fetch('../php/admin.php', {
                    method: 'POST',
                    body: formData,
                });

                // Verifica si la respuesta fue exitosa
                if (!response.ok) {
                    console.error('Error en la solicitud:', response.status, response.statusText);
                    alert('Hubo un error con la solicitud al servidor.');
                    return;
                }

                // Intenta analizar la respuesta JSON
                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    document.getElementById(`user-${userId}`).remove();
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error('Error al procesar la solicitud:', error);
                alert('Hubo un problema al procesar la solicitud. Intenta nuevamente.');
            }
        }
    });
});
