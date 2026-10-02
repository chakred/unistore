/**
 * Shared Slavic pluralization rule (Russian, Ukrainian): picks between
 * "one" / "few" / "many" grammatical forms based on the count.
 *
 * Used for message strings formatted as:
 *   '{count} форма_1 | {count} форма_2 | {count} форма_3'
 */
export function slavicPluralRule(choice) {
    if (choice === 0) {
        return 2;
    }

    const mod10 = choice % 10;
    const mod100 = choice % 100;

    if (mod10 === 1 && mod100 !== 11) {
        return 0;
    }

    if (mod10 >= 2 && mod10 <= 4 && (mod100 < 10 || mod100 >= 20)) {
        return 1;
    }

    return 2;
}
