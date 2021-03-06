async function authenticate() {
    const url = 'https://localhost:5000/api/users/authenticate';

    const response = await fetch(url, {
        method: 'GET',
        mode: 'cors',
        credentials: 'include',
        headers: {
            'Origin': 'http://localhost:5500/'
        }
    });

    if (!response.ok) {
        handleError(response);
    }
    else {
        // all good
        const r = await parseAuthResponse(response);
        return r.id;
    }
}

async function parseAuthResponse(response) {
    try {
        const r = await response.json();
        return r;
    }
    catch (err) {
        console.log('could not get id from response');
        console.dir(err);

        return ({});
    }
}

async function getUser(id) {
    const url = `https://localhost:5000/api/users/${id}`;

    const response = await fetch(url, {
        method: 'GET',
        mode: 'cors',
        credentials: 'include',
        headers: {
            'Origin': 'http://localhost:5500'
        }
    });

    if (!response.ok) {
        handleError(response);
    }
    else {
        const u = await parseAuthResponse(response);
        return u;
    }
}

function handleError(response) {
    if (response.status === 401) {
        console.log('User is not authenticated');
    }
    else if (response.status === 404) {
        console.log('User not found');
    }

    return ({});
}

async function logout() {
    const url = `https://localhost:5000/api/users/logout`;

    const response = await fetch(url, {
        method: 'GET',
        mode: 'cors',
        credentials: 'include',
        headers: {
            'Origin': 'http://localhost:5500'
        }
    });

    if (response.ok) {
        window.location.replace('/sign_in.php');
    }
}