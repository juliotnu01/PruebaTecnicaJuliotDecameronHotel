const Layout = ({ children }) => {
    return (
        <div>
            <header style={{ padding: '1rem', backgroundColor: '#f8f9fa' }}>
                <h1>Hoteles Decameron</h1>
                <nav>
                    <a href="/hoteles" style={{ marginRight: '1rem' }}>
                        Hoteles
                    </a>
                    <a href="/tipos-habitacion">Tipos de Habitación</a>
                </nav>
            </header>
            <main style={{ padding: '1rem' }}>{children}</main>
        </div>
    );
};

export default Layout;
