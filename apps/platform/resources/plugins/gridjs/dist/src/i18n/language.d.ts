declare type MessageFormat = (...args: any[]) => string;
declare type Message = string | MessageFormat;
export declare type Language = {
    [key: string]: Message | Language;
};
export declare class Translator {
    private readonly _language;
    private readonly _defaultLanguage;
    constructor(language?: Language);
    /**
     * Tries to split the message with "." and find
     * the key in the given language
     *
     * @param message
     * @param lang
     */
    getString(message: string, lang: Language): MessageFormat;
    translate(message: string, ...args: any[]): string;
}
export declare function useTranslator(translator: Translator): (message: string, ...args: any[]) => string;
export {};
