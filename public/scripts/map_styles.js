function styleRegional(feature) {
    return {
        fillOpacity: 0.2, 
        opacity: 0.5,
        weight: 3,
        color: '#3388ff',
    };
}
function styleMaps(feature) {
    return {
        fillOpacity: 0.2, 
        opacity: 0.5,
        weight: 3,
        color: 'orange',
    };
}
function styleIntersection(feature) {
    return {
        fillOpacity: 0.5, 
        weight: 3, 
        opacity: 0.5,
        color: '#d32535',
        dashArray: '20 10',
        lineCap: 'square'
    };
}

var iconPoint = {
    'b': L.icon({ iconUrl: APP_URL+'/img/point-blue.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'd': L.icon({ iconUrl: APP_URL+'/img/point-gold.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'e': L.icon({ iconUrl: APP_URL+'/img/point-darkgreen.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'g': L.icon({ iconUrl: APP_URL+'/img/point-green.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'm': L.icon({ iconUrl: APP_URL+'/img/point-maroon.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'n': L.icon({ iconUrl: APP_URL+'/img/point-navy.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'o': L.icon({ iconUrl: APP_URL+'/img/point-orange.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'r': L.icon({ iconUrl: APP_URL+'/img/point-red.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'u': L.icon({ iconUrl: APP_URL+'/img/point-purple.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
    'w': L.icon({ iconUrl: APP_URL+'/img/point-brown.png', iconSize: [30, 36], popupAnchor: [-3, -30] }),
};

function styleLeaflet(feature, colorcode) {
    colorname = '';
    switch (colorcode) {
        case 'b': colorname = 'blue'; break;
        case 'd': colorname = 'gold'; break;
        case 'e': colorname = 'darkgreen'; break;
        case 'g': colorname = 'green'; break;
        case 'm': colorname = 'maroon'; break;
        case 'n': colorname = 'navy'; break;
        case 'o': colorname = 'orange'; break;
        case 'r': colorname = 'red'; break;
        case 'u': colorname = 'purple'; break;
        case 'w': colorname = 'brown'; break;
    }
    return {
        fillOpacity: 0.2, 
        opacity: 0.5,
        weight: 3,
        color: colorname,
    };
}
