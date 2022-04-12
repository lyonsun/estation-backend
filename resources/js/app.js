require('./bootstrap');

const { default: axios } = require('axios');

(function () {
    const btnFindStation = document.querySelector('#btn-find-station');
    const inputLatitude = document.querySelector('#input-latitude');
    const inputLongitude = document.querySelector('#input-longitude');
    const inputRadius = document.querySelector('#input-radius');

    btnFindStation.addEventListener('click', function () {
        if (!inputLatitude.value) {
            alert('Please enter latitude');
            return;
        }

        if (!inputLongitude.value) {
            alert('Please enter longitude');
            return;
        }

        if (!inputRadius.value) {
            alert('Please enter radius');
            return;
        }

        const latitude = inputLatitude.value;
        const longitude = inputLongitude.value;
        const radius = inputRadius.value;

        getStations(latitude, longitude, radius);
    });

    const getStations = (latitude, longitude, radius) => {
        axios.get('/api/stations/nearby', {
            params: {
                latitude,
                longitude,
                radius
            }
        })
            .then(function (response) {
                // console.log(response);
                if (response.status === 200) {
                    const responseData = response.data
                    const stations = responseData.data
                    const stationsList = document.querySelector('#stations-list');
                    stationsList.innerHTML = '';

                    // stations.map(station => {
                    // console.log(stations)
                    // });
                    for (var stationAddress in stations) {
                        console.log(stationAddress)
                        const stationList = stations[stationAddress];
                        console.log(stationList)

                        stationList.map(station => {
                            console.log(station)
                            const stationItem = document.createElement('li');
                            stationItem.innerHTML = `
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${station.name}</h5>
                                    <p class="card-text">${station.address}</p>
                                    <p class="card-text">${station.distance}</p>
                                </div>
                            </div>
                        `;
                            stationsList.appendChild(stationItem);
                        });
                    }

                    // stations.forEach((stationAddress, stations) => {
                    //     console.log(stationAddress)
                    //     // const stationAddress = document.createElement('p');
                    //     // stationAddress.innerHTML = stationAddress;
                    //     // stationsList.appendChild(stationAddress);
                    // });
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }
})();