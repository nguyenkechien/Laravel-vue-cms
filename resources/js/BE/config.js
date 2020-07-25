const NODE_ENV = process.env.NODE_ENV;

const dev = {
    DOMAIN_API: "http://127.0.0.1:8000"
};

const prod = {
    DOMAIN_API: "https://127.0.0.2"
};

export const config = NODE_ENV == "development" ? dev : prod;
