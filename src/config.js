/**
 * Your weekly grocery budget.
 * This is for your "Groceries" category only, by default.
 */
export const budget = 100;

/**
 * Chooses an image to display according to what percentage of the budget has been spent this week.
 */
export const percentImages = [
    { percent: 0.3, image: 'cat-happy.gif'},    // Up to 30% shows this image
    { percent: 0.6, image: 'cat-happy-2.gif'},  // Up to 60% shows this one
    { percent: 0.8, image: 'cat-tongue.gif'},   // Etc.
    { percent: 0.9, image: 'cat-shocked.gif'},
    { percent: 1, image: 'cat-fat.gif'},
    { percent: 1.1, image: 'cat-fall.gif'},
    { percent: 1.2, image: 'cat-fall-2.gif'},
    { percent: 10, image: 'cat-hell-no.gif'},   // This is the last image, up to 1000%. If you go past that, what are you doing??
];

/**
 * Base URL of your API endpoint.
 * You will need to change this, depending upon your dev and production situation.
 */
export const apiLink = 'http://localhost/the-food-budget/src/api/';