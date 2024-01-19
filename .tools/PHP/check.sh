#!/bin/sh

EXIST_CODE=0
readonly BACKGROUND_GREEN_COLOR='\033[0;42m'
readonly RED_COLOR='\033[0;31m'
readonly ORANGE_COLOR='\033[0;33m'
readonly GREEN_COLOR='\033[0;32m'
readonly NO_COLOR='\033[0m'
readonly PHP_STAGED_FILES=$(git ls-files -c -i --exclude=app/app/routes/* --exclude=app/app/Jobs/* --exclude=app/app/Http/Controllers/* --exclude=app/app/Console/Commands/* --exclude=app/app/Services/* --exclude=app/app/Repositories/* --exclude=app/app/Utilities/* --exclude=app/app/Imports/* --exclude=app/app/Util/* --exclude=app/app/Contract/* --exclude=app/app/Code/Provider --exclude=app/app/Enum | grep '.php')
readonly PHP_STAGED_FILES_SEPARATE_BY_SPACE=$(echo -e $PHP_STAGED_FILES | tr "\n" " ")

output() {
    echo -e "${ORANGE_COLOR}$1${NO_COLOR}"
}

output_error() {
    echo -e "${RED_COLOR}$1${NO_COLOR}"
}

output_warning() {
    echo -e "${ORANGE_COLOR}$1${NO_COLOR}"
}

output_success() {
    echo -e "${GREEN_COLOR}$1${NO_COLOR}"
}

output_ending_line() {
    printf '%.s=' {1..79}
    echo ''
}

check_syntax_error() {
    #check empty string
    [[ -z "${PHP_STAGED_FILES}" ]] && return 0

    output "<============ Begin check syntax error ============>"
    php -v > /dev/null 2>&1

    if [[ "$?" != "0" ]]; then
        output_warning "Skipping task: php files check syntax error because not found 'php' in system PATH"
        return 0
    fi

    for file in ${PHP_STAGED_FILES_SEPARATE_BY_SPACE};
    do
        [[ ! -f $file ]] && continue
        output_warning php -l $file 1>/dev/null
        [[ $? -ne 0 ]] && EXIT_CODE=1
    done
    output "<============ End check syntax error ============>"
}

fix_format_code() {
    output "<============ Begin fix format code ============>"
    for file in ${PHP_STAGED_FILES_SEPARATE_BY_SPACE};
    do
        [[ ! -f $file ]] && continue
        echo -e "${GREEN_COLOR}Detect file: $file${NO_COLOR}"
        ERROR_FORMAT=$(php tools/PHP/phpcbf.phar --standard=CodeSnifferRule $file)
        output_error "${ERROR_FORMAT}"
        git add $file
    done
    output "<============ End fix format code ============>"
}

check_code_sniffer() {
    output "<============ Begin check code sniffer ============>"
    for file in ${PHP_STAGED_FILES_SEPARATE_BY_SPACE};
    do
        [[ ! -f $file ]] && continue
        echo -e "${GREEN_COLOR}Detect file: $file${NO_COLOR}"
        ERROR_SNIFFER=$(php tools/PHP/phpcs.phar --standard=CodeSnifferRule $file)
        [[ $? -ne 0 ]] && EXIT_CODE=1
        output_error "${ERROR_SNIFFER}"
    done
    output "<============ End check code sniffer ============>"
}

check_mess_code() {
    output "<============ Begin check mess code ============>"
    for file in ${PHP_STAGED_FILES_SEPARATE_BY_SPACE};
    do
        [[ ! -f $file ]] && continue
        echo -e "${GREEN_COLOR}Detect file: $file${NO_COLOR}"
        ERROR_MESS=$(php tools/PHP/phpmd.phar $file ansi tools/PHP/PHPMD/ruleset.xml --generate-baseline 2>/dev/null)
        [[ $? -ne 0 ]] && EXIT_CODE=1
        output_error "${ERROR_MESS}"
    done
    output "<============ End check mess code ============>"
}

check_debugging() {
    output "<============ Begin check debugging ============>"
    for file in ${PHP_STAGED_FILES_SEPARATE_BY_SPACE};
    do
        [[ ! -f $file ]] && continue
        echo -e "${GREEN_COLOR}Detect file: $file${NO_COLOR}"
        ERROR=$(grep -rn $file -e 'dump(' -e 'exit(' -e 'die(' -e 'var_dump(')
        ERROR_DD=$(grep -E "([^(A-Za-z0-9)]dd\()" -rn $file)
        [[ $? -ne 1 ]] && EXIT_CODE=1
        output_error "${ERROR}${ERROR_DD}"
    done
    output "<============ End check debugging ============>"
}

main() {
    check_syntax_error
    echo ""
    echo ""
    fix_format_code
    echo ""
    echo ""
    check_code_sniffer
    echo ""
    echo ""
    check_mess_code
    echo ""
    echo ""
    check_debugging
    exit $EXIT_CODE
}

main